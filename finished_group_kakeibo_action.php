<?php
$action_person = $_POST['action_person'];
$pdo = new PDO('mysql:host=localhost;dbname=test', admin, admin);
$stt = $pdo-> prepare('insert into group_kakeibo_action values(null, :action_date, :action_person, :himoku,
	:memo, :income, :outcome)');
	$stt->bindValue(':action_date', $_POST['action_date']);
	$stt->bindValue(':action_person', $_POST['action_person']);
	$stt->bindValue(':himoku', $_POST['himoku']);
	$stt->bindValue(':memo', $_POST['memo']);
	$stt->bindValue(':income', $_POST['income']);
	$stt->bindValue(':outcome', $_POST['outcome']);
	$stt->execute();
	
	
	
echo $action_person,'の家計簿を、登録しました';
print('<br />');
echo '<a href="search_group_kakeibo_action.php">家計簿一覧表示</a>';
print('<br />');
print('<a href="input_group_kakeibo_action.php">入力画面に移動する</a>');

/* ここどうかな bindValue　のやつを入れようかな、、、
 * 
 * 
 */


?>