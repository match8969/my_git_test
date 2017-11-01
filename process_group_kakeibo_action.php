<?php 
require_once 'DbManager.php';
require_once '../../Encode.php';

session_start();

$start_year = e($_GET['start_yeat']);
$start_month =e($_GET['start_month']);
$end_year= e($GET['end_year']);
$end_month =e($_GET['end_month']);

try {
	$pdo = getDb();
	$sql =
		"select * from group_kakeibo_action 
		where year(action_date) >= :start_year and month(action_date) >= :start_month and
				year(action_date) <= :end_year and month(action_date) <= :end_month
				order by action_date desc";
	$stt = $pdo->prepare($sql);
	$stt->bindValue(':start_year', $start_year);
	$stt->bindValue(':start_month', $start_month);
	$stt->bindValue(':end_year', $end_year);
	$stt->bindValue(':end_month', $end_month);
	$stt ->execute();
	
	$_SESSION['result'] = $stt ->fetchAll(PDO:: FETCH_ASSOC); 
	/* ここfetchAll にしてるのは、　連想配列という配列にしている　SESSION 
	 * 
	 */
} catch (Exception $e) {
	print('エラーメッセじ'.$e->getMessage());
}
//header('Location: http://'.$_SERVER['HTTP_HOST'].'output_group_kakeibo_action.php');
header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/output_group_kakeibo_action.php');


?>

