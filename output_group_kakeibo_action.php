<?php 
require_once 'DbManager.php';
session_start();
?>

<html>
<head>
<meta charset="UTF-8" />
<title>検索結果の表示</title>
</head>
<body>
<h1>検索結果</h1>

<h3>期間検索を行う</h3>
<form method="GET" action="process_group_kakeibo_action.php">
開始月：
<select name="start_year">
<?php 
	for($i =2015; $i <=2017; $i++){
?>		
	<option value="<?=$i ?>" ><?= $i?></option> 
<?php 
	}
?>
</select>年
<select name="start_month">
<?php 
	for($i =1; $i <=12; $i++){
?>		
	<option value="<?= $i?>" ><?= $i?></option>
<?php 	}?>

</select>月~終了:
<select name="end_year">
<?php 
	for($i =2015; $i <=2017; $i++){
?>		
	<option value="<?= $i?>" ><?= $i?></option>
<?php } ?>
</select>年
<select name="end_month">
<?php 
	for($i =1; $i <=12; $i++){
?>		
	<option value="<?= $i?>" ><?= $i?></option>
<?php } ?>

</select>月

<input type="submit" value="検索" />
</form>
<hr />

<h2>以下の検索結果が見つかりました。</h2>


<table border="1">
<tr><th>日付</th><th>人物</th><th>費目</th><th>メモ</th><th>入金額</th><th>出金額</th></tr>


<?php 
if (isset($_SESSION['result'])){
	$result=$_SESSION['result'];
	foreach($result as $row){
?>
<tr>
<td><?=$row['action_date'] ?></td>
<td><?=$row['action_person'] ?></td>
<td><?=$row['himoku'] ?></td>
<td><?=$row['memo'] ?></td>
<td class="price"><?=$row['income'] ?></td>
<td class="price"><?=$row['outcome'] ?></td>
</tr>
<?php } } ?>
</table>

<hr>
<table>
<?php 
$pdo = getDb();
try {
	$stt = $pdo-> prepare('select * from group_kakeibo_action 
		where action_date= :action_date or action_person = :action_person
			or himoku = :himoku or memo = :memo or income = :income or outcome = :outcome	
');
	
	$stt->bindValue(':action_date', $_POST['action_date']);
	$stt->bindValue(':action_person', $_POST['action_person']);
	$stt->bindValue(':himoku', $_POST['himoku']);
	$stt->bindValue(':memo', $_POST['memo']);
	$stt->bindValue(':income', $_POST['income']);
	$stt->bindValue(':outcome', $_POST['outcome']);
	
	
	
	
	$stt-> execute();
	while($row = $stt -> fetch(PDO:: FETCH_ASSOC)){
	?>
	<tr>
	<td><?php print($row['action_date']); ?></td> <!-- ここ<?=row['action_date'] ?>とかで省略するのが今風 --> 
	<td><?php print($row['action_person']);?></td>
	<td><?php print($row['himoku']);?></td>
	<td><?php print($row['memo']);?></td>
	<td><?php print($row['income']);?></td>
	<td><?php print($row['outcome']);?></td>   
	</tr>
		
		
	<?php 	
	}
	
} catch (Exception $e) {
	print('エラーメッセージ'.$e->getMessage());
}
?>

</table>
<a href="search_group_kakeibo_action.php" >家計簿検索ページにもどる</a><br />
<a href="input_group_kakeibo_action.php">入力画面に移動する</a>

</body>

</html>