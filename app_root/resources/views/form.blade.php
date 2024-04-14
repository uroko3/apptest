<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<form action="/form" method="post">
		{{csrf_field()}}
		TEST：<input type="text" name="name" size="30" value="{{old('name')}}"><span>{{$errors->first('name')}}</span><br>
		TEST2：<input type="text" name="name2" size="30" value="{{old('name2')}}"><span>{{$errors->first('name2')}}</span><br>
		<button type="submit" name="action" value="send">確認画面へ</button>
	</form>
</body>
</html>