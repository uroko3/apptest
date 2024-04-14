<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<form action="/form/complete" method="post">
		{{csrf_field()}}
		TEST：<br>
		TEST2：<br>
		<button type="submit" name="action" value="send">確定</button>
	</form>
</body>
</html>