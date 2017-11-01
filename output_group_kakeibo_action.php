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
//以下、検索したもののあとで、検索した月日を残す仕掛け。
$start_year = isset($_SESSION['start_year'])?$_SESSION['start_year']: "";// ここは条件演算子。
	for($i =2015; $i <=2017; $i ++){
		print('<option value="'.$i.'"');
		if($i == $start_year){
			print(' selected');
		}
	print('>'.$i.'</option>');
	}
?>		

</select>年
<select name="start_month">
<?php 
//以下、検索したもののあとで、検索した月日を残す仕掛け。
$start_month = isset($_SESSION['start_month'])?$_SESSION['start_month']: "";// ここは条件演算子。
	for($i =1; $i <=12; $i ++){
		print('<option value="'.$i.'"');
		if($i == $start_month){
			print(' selected');
		}
	print('>'.$i.'</option>');
	}
?>	
</select>月~終了:
<select name="end_year">
<?php 
//以下、検索したもののあとで、検索した月日を残す仕掛け。
$end_year = isset($_SESSION['end_year'])?$_SESSION['end_year']: "";// ここは条件演算子。
	for($i =2015; $i <=2017; $i ++){
		print('<option value="'.$i.'"');
		if($i == $end_year){
			print(' selected');
		}
	print('>'.$i.'</option>');
	}
?>
</select>年
<select name="end_month">
<?php 
//以下、検索したもののあとで、検索した月日を残す仕掛け。
$end_month = isset($_SESSION['end_month'])?$_SESSION['end_month']: "";// ここは条件演算子。
	for($i =1; $i <=12; $i ++){
		print('<option value="'.$i.'"');
		if($i == $end_month){
			print(' selected');
		}
	print('>'.$i.'</option>');
	}
?>
</select>月

<input type="submit" value="検索" />
</form>
<ul>
<?php 
 if(isset($_SESSION['errors'])){
 	foreach($_SESSION['errors'] as $error){
 		print("<li>{$error}</li>");
 	}
 }

?>

</ul>

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