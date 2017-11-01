<html>
<head>
<meta charset="UTF-8" />
<title>家計簿の内容検索</title>
</head>
<body>
<h1>一項目で検索</h1>
<h2>日付で検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="date" name="action_date">
<input type="submit" value="検索">
</form>
<!--  
<h3>期間検索を行う</h3>
<form method="GET" action="process_group_kakeibo_action.php">
開始：
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
<?php 
	}
?>

</select>月~終了:
<select name="start_year">
<?php 
	for($i =2015; $i <=2017; $i++){
?>		
	<option value="<?= $i?>" ><?= $i?></option>
<?php 
	}
?>
</select>年
<select name="start_month">
<?php 
	for($i =1; $i <=12; $i++){
?>		
	<option value="<?= $i?>" ><?= $i?></option>
<?php 
	}
?>

</select>月





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




<input type="submit" value="検索" />
</form>
-->


<h2>人物で検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="text" name="action_person">
<input type="submit" value="検索">
</form>

<h2>費目で検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="text" name="himoku">
<input type="submit" value="検索">
</form>

<h2>メモで検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="text" name="memo">
<input type="submit" value="検索">
</form>
<h2>入金額で検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="number" name="income">
<input type="submit" value="検索">
</form>
<h2>出金額で検索</h2>
<form action="output_group_kakeibo_action.php" method="post">
<input type="number" name="outcome">
<input type="submit" value="検索">
</form>

<a href="input_group_kakeibo_action.php" >入力画面に移動する</a>

</body>
</html>
