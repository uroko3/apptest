@foreach($list as $branch)
	<div>{{$branch}}</div>
@endforeach

<div>access_token:{{$access_token}}</div>
<div>access_token:{{$access_token_ref}}</div>

@if(Auth::check())
	{{\Auth::user()->name}}さん<br>
@endif
