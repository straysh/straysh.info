@extends($layout)


@section('content-header')
	
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('roles.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	
	<div>
		@include('backend.roles.form', array('model' => $role) + compact('permission_role'))
	</div>

@stop
