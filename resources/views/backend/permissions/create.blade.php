@extends($layout)


@section('content-header')
	
	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('permissions.index', 'Back') !!}</small>
	</h1>
	
@stop
@section('content')
	
	<div>
		@include('backend.permissions.form')
	</div>

@stop
