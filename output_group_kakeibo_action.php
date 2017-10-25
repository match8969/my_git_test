<?php 
require_once 'DbManager.php';
?>

<html>
<head>
<meta charset="UTF-8" />
<title>検索結果の表示</title>
</head>
<body>
<h1>検索結果</h1>
<h2>以下の検索結果が見つかりました。</h2>

<?php 
$pdo = getDb();
try {
	$stt = $pdo-> prepare('select * from group_kakeibo_action where action_date= :action_date');
	
	$stt->bindValue(':action_date', $_POST['action_date']);
	$stt-> execute();
	while($row = $stt -> fetch(PDO:: FETCH_ASSOC)){
		print('日付:'.$row['action_date'].'<br />');
		print('人物:'.$row['action_person'].'<br />');
		print('費目:'.$row['himoku'].'<br />');
		print('メモ:'.$row['memo'].'<br />');
		print('入金額:'.$row['income'].'<br />');
		print('出金額:'.$row['outcome'].'<br />');
		
		
	}
	
} catch (Exception $e) {
	print('エラーメッセージ'.$e->getMessage());
}
?>
<a href="search_group_kakeibo.php" >家計簿検索ページにもどる</a>
</body>

</html>