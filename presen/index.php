<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>本管理システム</title>
</head>

<body>

<h2>本一覧</h2>
<br>
ひらがなで入力してください

<form action="index.php" method="POST">

<!-- ＩＤ
<input type="text" name="id" size="10">
-->

<table>
<tr>
<th>本名</th>
<td><input type="text" name="name" size="20"></td></td>
</tr>

<tr>
<th>著者</th>
<td><input type="text" name="author" size="20"></td></th>
</tr>

<tr>
<th>ジャンル</th>
<td><select name="cate" size="1">
	<option value="">選択しない</option>
	<option value="資格">資格</option>
	<option value="文学">文学</option>
	<option value="電気工学">電気工学</option>
	<option value="スポーツ">スポーツ</option>
	<option value="産業">産業</option>
	<option value="機械工学">機械工学</option>
	<option value="化学">化学</option>
	<option value="数学">数学</option>
	<option value="法律・経済">法律・経済</option>
	<option value="小説">小説</option>
</select></td></tr>
</table>
　　　　　　　　　　　　　　<input type="submit" name="search" value="検索">
<br>
<br>
<a href="login.php">登録・削除</a>
</form>

<br><br>

<?php

    if (!isset($_POST['search'])) {		// 何もボタンが押されていない場合
        exit;
    }

// 検索

// ＳＱＬ文の作成
    $sql   = "SELECT * FROM book_list";	// 全検索のＳＱＬ文
    $where = " WHERE '1'='1'";			// 常時成立する条件

    if ($_POST['name'] != "") {				// 名前の条件追加
        $where .= " AND name_hira like '%${_POST['name']}%'";	// ' AND name=〜 '
    }
    if ($_POST['cate'] != "") {			// ジャンルの条件追加
        $where .= " AND category='${_POST['cate']}'";	// ' AND score=〜 '
    }
    if ($_POST['author'] != "") {			// 著者の条件追加
        $where .= " AND author_hira like '%${_POST['author']}%'";	// ' AND score=〜 '
    }

    $sql = $sql . $where;

// デバッグ用（作成されたＳＱＬ文を画面表示）
//   print "SQL: ${sql}<br>\n";

// ＤＢサーバへの接続
    $con = pg_connect("dbname='www' user='apache' password='passworda'");
    if (!$con){
        print "ＤＢサーバへの接続に失敗しました<br>\n";
        exit;
    }

// ＳＱＬ文の実行
    $R = pg_query($con, $sql);
    if (!$R){
        print "SQL: ${sql};<br>\n";
        print "テーブルの検索に失敗しました<br>\n";
        exit;
    }

// 検索結果の件数
    $rows = pg_num_rows($R);

// 検索結果の表示（表形式）
    if ($rows > 0){
        print "<table border=\"1\">\n";
        print "<tr><th>本名</th> <th>著者</th> <th>ジャンル</th></tr>\n";
    }
    for ($i = 0; $i < $rows; $i++){
        $data = pg_fetch_array($R, $i);
        print "<tr><td>${data['name']}</td> <td>${data['author']}</td> <td>${data['category']}</td></tr>\n";
    }
    if ($rows > 0){
        print "</table>\n";
    } else {
        print "そのようなデータは登録されていません<br>\n";
    }

// 検索結果の削除
    pg_free_result($R);

// ＤＢサーバ切断
    pg_close($con);


?>

</body>
</html>
