<?php
require_once 'DbManager.php';
require_once '../../Encode.php';

session_start ();

$start_year = e ( $_GET ['start_year'] ); // htmpspecialchar でオK
$start_month = e ( $_GET ['start_month'] );
$end_year = e ( $_GET ['end_year'] );
$end_month = e ( $_GET ['end_month'] );

$_SESSION ['start_year'] = e ( $_GET ['start_year'] );
$_SESSION ['start_month'] = e ( $_GET ['start_month'] );
$_SESSION ['end_year'] = e ( $_GET ['end_year'] );
$_SESSION ['end_month'] = e ( $_GET ['end_month'] );
//入力チェック!!!!!!!!!
$start_date = date ( 'Ymd', mktime ( 0, 0, 0, $_SESSION ['start_month'], 1, $_SESSION ['start_year'] ) ); // mktime()を使っているから
$end_date = date ( 'Ymd', mktime ( 0, 0, 0, $_SESSION ['end_month'], 1, $_SESSION ['end_year'] ) );

$errors = array ();
if ($start_date > $end_date) {
	$errors [] = "終了年月は開始年月よりあとの年月を入力してください";
} 
if(count($errors)>0){
	$_SESSION['errors'] = $errors;
	unset($_SESSION['result']); // $_SESSION[]の中身をからにした。resultを取り除いた。
}else {
	
	unset($_SESSION['errors']); //ずっとエラーメッセージを表示させないため。
	try {
		$pdo = getDb ();
		$sql = "select * from group_kakeibo_action 
		where year(action_date) >= :start_year and month(action_date) >= :start_month and 
				year(action_date) <= :end_year and month(action_date) <= :end_month
				order by action_date desc";
		// ここ'.$start_month.’だとSQLインジェクション攻撃を受ける。文字列結合は厳禁！！
		/*
		 * パターン 2!!!!! インデックスを使えて高速！！な記述.
		 * select * from group_kakeibo_action
		 * where action_date > :start and action_date < :end
		 * order by action_date desc" にしてもイイって。 --A
		 */
		$stt = $pdo->prepare ( $sql );
		$stt->bindValue ( ':start_year', $start_year );
		/*
		 * P2!! 下記に変えれば！！ インテックスできるて。
		 * bindvalue (':start', $start_year.'-'.$start_month.'-01');
		 * if ($end_month==12){
		 * $end_month =1;
		 * $end_year +=1;
		 * }
		 * $stt ->bindvalue (':end', $end_year.'-'.$end_month.'-01');
		 */
		$stt->bindValue ( ':start_month', $start_month );
		$stt->bindValue ( ':end_year', $end_year );
		$stt->bindValue ( ':end_month', $end_month );
		$stt->execute ();
		
		$_SESSION ['result'] = $stt->fetchAll ( PDO::FETCH_ASSOC );
		/*
		 * ここfetchAll にしてるのは、 連想配列方式の配列にしている SESSION
		 *
		 */
	} catch ( PDOException $e ) {
		print ('エラーメッセじ' . $e->getMessage ()) ;
	}
}
// header('Location: http://'.$_SERVER['HTTP_HOST'].'output_group_kakeibo_action.php');
header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] . dirname ( $_SERVER ['PHP_SELF'] ) . '/output_group_kakeibo_action.php' );

?>

