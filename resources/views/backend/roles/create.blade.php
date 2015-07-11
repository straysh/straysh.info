@extends($layout)

@section('content-header')
	
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('roles.index', 'Back') !!}</small>
	</h1>
	
@stop

@section('content')

	<div>
		@include('backend.roles.form')
	</div>

@stop
