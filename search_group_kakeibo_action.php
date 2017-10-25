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
