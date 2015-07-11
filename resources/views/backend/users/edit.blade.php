@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('users.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('backend.users.form', array('model' => $user) + compact('role'))
	</div>

@stop
