<html>
<head>
<meta charset="UTF-8">
<title>入力用画面(家計簿)</title>
</head>
<body>

<form action="finished_group_kakeibo_action.php" method="post">

<h2>日付</h2>
<input type="date" name="action_date" />
<h2>人物</h2>
<input type="text" name="action_person" />
<h2>費目</h2>
<input type ="text" name ="himoku">
<h2>メモ</h2>
<input type="text" name="memo">
<h2>入金額</h2>
<input type="number" name="income" >
<h2>出金額</h2>
<input type="number" name="outcome" >

<br>
<input type="submit" value="登録">

</form>
</body>

</html> 
