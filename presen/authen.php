<!DOCTYPE html">
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>管理者ページ</title>
</head>

<body>

<?php

// ユーザ認証チェック
function error_exit($errno) {		// エラー処理関数
	switch ($errno) {


    case 2:				// ユーザ認証失敗
        print <<< _ERROR2
ユーザ名またはパスワードが違います！<br><br>
<a href="login.php">戻る</a>
</body>
</html>
_ERROR2;
        break;
   }
    exit;
}

    $uname = $_POST['uname'];
    $pass  = $_POST['pass'];

    if ($uname != "1" || $pass != "1234") { error_exit(2); }




?>

<h2>本新規登録、既存本削除</h2>

<a href="index.php">戻る</a>

<form action="authen.php" method="POST">
<table>
<tr><th>本名</th> <td><input type="text" name="name" size="15"></td></tr>
<tr><th>本よみがな</th> <td><input type="text" name="name_hira" size="20"></td></tr>
<tr><th>著者</th> <td><input type="text" name="author" size="15"></td></tr>
<tr><th>著者よみがな</th> <td><input type="text" name="author_hira" size="20"></td></tr>
<tr><th>ジャンル</th> <td><select name="cate" size="1">
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
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="pass" value="<?php echo $pass; ?>">
<input type="submit" name="book" value="検索">
<input type="submit" name="book" value="登録">
</form>

<?php
	
	
	
	if ($_POST['book']=="検索") {
        	include('./sakujo.php');
        	
    	}
    	elseif($_POST['book']=="登録"){
    		include('./touroku.php');
    	}else{
    		exit;
    	}

?>

</body>
</html>



