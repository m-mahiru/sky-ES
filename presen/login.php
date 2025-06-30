<!DOCTYPE html">
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>

<body>
本を登録・削除するにはパスワードが必要です。<br>
<form action="authen.php" method="POST">
<table>
<tr><th>ユーザ名</th> <td><input type="text" name="uname" size="10"></td></tr>
<tr><th>パスワード</th> <td><input type="password" name="pass" size="10"></td></tr>
<tr><td></td> <td><input type="submit" value="ログイン"><a href="index.php">戻る</a></td></tr>
</table>
</form>

</body>
</html>
