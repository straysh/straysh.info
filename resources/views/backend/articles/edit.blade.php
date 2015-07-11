@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		@if(isOnPages())
		<small>{!! link_to_route('pages.index', 'Back') !!}</small>
		@else
		<small>{!! link_to_route('articles.index', 'Back') !!}</small>
		@endif
	</h1>
@stop

@section('content')

	<div>
		@include('backend.articles.form', array('model' => $article))
	</div>

@stop
