@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form action="/form2" method="post">
	{{csrf_field()}}
	名前：<input type="text" name="name" value="{{old('name')}}">@if ($errors->has('name')){{$errors->first('name')}}@endif<br>
	年齢：<input type="text" name="age" value="{{old('age')}}">@if ($errors->has('age')){{$errors->first('age')}}@endif<br>
	性別：男：<input type="radio" name="sex" value="男">　女：<input type="radio" name="sex" value="女"><br>
	<button type="submit" name="send" value="send">send</button>
</form>