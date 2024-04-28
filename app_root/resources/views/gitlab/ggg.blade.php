@foreach($x as $l)
	@foreach($l as $k=>$v)
		<div>{{$k}} =&gt; {!! nl2br(print_r($v, true)) !!}</div>
	@endforeach
@endforeach