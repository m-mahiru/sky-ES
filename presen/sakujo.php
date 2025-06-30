<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>本管理システム</title>
</head>

<body>



<?php



// ＳＱＬ文の作成
    $sql   = "SELECT * FROM book_list";	// 全検索のＳＱＬ文
    $where = " WHERE '1'='1'";			// 常時成立する条件

    if ($_POST['name_hira'] != "") {				// 名前の条件追加
        $where .= " AND name_hira='${_POST['name_hira']}'";	// ' AND name=〜 '
    }
    if ($_POST['cate'] != "") {			// ジャンルの条件追加
        $where .= " AND category='${_POST['cate']}'";	// ' AND score=〜 '
    }
    if ($_POST['author_hira'] != "") {			// 著者の条件追加
        $where .= " AND author_hira='${_POST['author_hira']}'";	// ' AND score=〜 '
    }

    $sql = $sql . $where;
    $sql1 = $sql;

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

?>
<form action="sakujo.php" method="POST">

<?php
// 検索結果の表示（表形式）
    if ($rows > 0){
        print "<table border=\"1\">\n";
        print "<tr><th>チェック</th><th>本名</th> <th>著者</th> <th>ジャンル</th></tr>\n";
    }
    for ($i = 0; $i < $rows; $i++){
        $data = pg_fetch_array($R, $i);
        ?>
        <tr><td><input type="checkbox" name=<?php print "$i";?> value=<?php print "${data['name']}";?>></td><td>
        <?php print "${data['name']}</td> <td>${data['author']}</td> <td>${data['category']}</td></tr>\n";
        
    }
    if ($rows > 0){
        print "</table>\n";
    } else {
        print "そのようなデータは登録されていません<br>\n";
    }

?>
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="pass" value="<?php echo $pass; ?>">
<input type="submit" name="book" value="削除">
</form>


<?php
if (!isset($_POST['book'])) {		// 何もボタンが押されていない場合
        exit;
}

pg_free_result($R);
$sql = "delete from book_list " ;
$where = "where '0'='1' ";

for ($i = 0; $i < $rows; $i++){
	if(isset($_POST[$i])){
		$where .= " or name = '${_POST[$i]}'";
	}
}
$sql = $sql . $where;
$R = pg_query($con, $sql);


// 検索結果の削除
    pg_free_result($R);

// ＤＢサーバ切断
    pg_close($con);


?>
</body>
</html>

