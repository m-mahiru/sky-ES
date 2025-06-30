<?php
	//登録
	if ($_POST['name']   == "" ||
	$_POST['name_hira']  == "" ||
	$_POST['author'] == "" ||  
	$_POST['author_hira']  == "" ||
	$_POST['cate']  == "" ) {
        	print "登録するときは全ての項目へ入力してください！<br>\n";
   		exit;
	}
    	$cate   = $_POST['cate'];
    	$name  = $_POST['name'];
    	$author = $_POST['author'];
    	$name_hira  = $_POST['name_hira'];
    	$author_hira = $_POST['author_hira'];

// ＳＱＬ文の作成
   	$sql = "INSERT INTO book_list (name, name_hira,category,author,author_hira) "
   	 . "VALUES ('${name}', '${name_hira}', '${cate}', '${author}', '${author_hira}')";

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
    	

// 検索結果の削除
    	pg_free_result($R);

// 登録したデータを検索してみる
    	$sql = "SELECT * FROM book_list " . "WHERE name='${name}' AND name_hira='${name_hira}' AND category='${cate}' AND author='${author}' AND author_hira='${author_hira}'";

// デバッグ用（作成されたＳＱＬ文を画面表示）
//    print "SQL: ${sql}<br>\n";

// ＳＱＬ文の実行
    	$R = pg_query($con, $sql);
    	if (!$R){
        	print "SQL: ${sql};<br>\n";
        	print "テーブルの検索に失敗しました<br>\n";
        	exit;
    	}

// 検索結果の件数
    	$rows = pg_num_rows($R);


    	if ($rows > 0){
        	print "データを登録しました<br>\n";
    	} else {
        	print "そのようなデータは登録されていません<br>\n";
    	}


    	

// 検索結果の削除
    	pg_free_result($R);

// ＤＢサーバ切断
    	pg_close($con);

?>
