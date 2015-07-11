@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('categories.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	
	<div>
		@include('backend.categories.form', array('model' => $category))
	</div>

@stop
