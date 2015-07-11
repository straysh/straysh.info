@extends($layout)

@section('content-header')
	
	
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('users.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('backend.users.form')
	</div>

@stop
