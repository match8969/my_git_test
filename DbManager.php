<?php 
function getDb(){
	$dsn='mysql:dbname=test; host=localhost; charset=utf8';
	$usr= 'admin';
	$passwd='admin';
	
	try {
		$db = new PDO($dsn, $usr, $passwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db ->exec('SET NAMES utf8');
	} catch (PDOException $e) {
		die("接続エラー:{$e->getMessage()}");
	}
	return  $db;
}

?>