<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>本管理システム</title>
</head>

<body>
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="pass" value="<?php echo $pass; ?>">
<a href="authen.php">modoru</a>
<?php


pg_free_result($R);
$sql = "delete from book_list " ;
$where = "where '0'='1' ";

for ($i = 0; $i < $rows; $i++){
	if(isset($_POST[$i])){
		$where .= " or name = '${_POST[$i]}'";
	}
}
$sql = $sql . $where;
print "$sql";
$R = pg_query($con, $sql);


// 検索結果の削除
    pg_free_result($R);

// ＤＢサーバ切断
    pg_close($con);


?>


</body>
</html>
