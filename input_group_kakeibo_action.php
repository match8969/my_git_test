<html>
<head>
<meta charset="UTF-8">
<title>入力用画面(家計簿)</title>
</head>
<body>

<form action="finished_group_kakeibo_action.php" method="post">
<h1>入力用画面</h1>
<h2>日付</h2>
<input type="date" name="action_date" />
<h2>人物</h2>
<input type="text" name="action_person" />
<h2>費目</h2> <!--  ここをオプションにしたいな。。 選択と、新しい費目を追加する的な-->
<select name="himoku">
<option value="食費" selected>食費</option>
<option value="光熱費">光熱費</option>
<option value="交際費">交際費</option>
<option value="書籍費">書籍費</option>
<option value="衣料費">衣料費</option>
<option value="交通費">交通費</option> <!-- やはりvalueが入力値 -->
<option value="雑費">雑費</option>
</select>

<br />
<!--  新しい費目の追加<br /> 
<input type ="text" name ="himoku"> -->
<!-- 二つ、入力するところがあると、selectの入力はダメだった  -->
<h2>メモ</h2>
<input type="text" name="memo">
<h2>入金額</h2>
<input type="number" name="income" >
<h2>出金額</h2>
<input type="number" name="outcome" >

<br>
<input type="submit" value="登録">

</form>
<a href="search_group_kakeibo_action.php">検索画面に移動する</a>
</body>

</html> 
