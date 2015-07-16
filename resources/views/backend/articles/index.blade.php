@extends($layout)

@section('content-header')
	@if( ! isOnPages())
	<h1>
		All Articles ({!! $articles->count() !!})
		&middot;
		<small>{!! link_to_route('articles.create', 'Add New') !!}</small>
	</h1>
	@else
	<h1>
		All Pages ({!! $articles->count() !!})
		&middot;
		<small>{!! link_to_route('pages.create', 'Add New') !!}</small>
	</h1>
	@endif
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Author</th>
			@if( ! isOnPages())
			<th>Category</th>
			@endif
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($articles as $article)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $article->title !!}</td>
				<td>{!! $article->author !!}</td>
				@if( ! isOnPages())
				<td>{!! $article->category ? $article->category->name : null !!}</td>
				@endif
				<td>{!! date('Y-m-d H:i:s', $article->created_at) !!}</td>
				<td class="text-center">
					@if(isOnPages())
						<a href="{!! route('pages.edit', $article->id) !!}">Edit</a>
						{{--&middot;--}}
						{{--@include('backend.partials.modal', ['data' => $article, 'name' => 'pages'])--}}
					@else
						<a href="{!! route('articles.edit', $article->id) !!}">Edit</a>
						{{--&middot;--}}
						{{--@include('backend.partials.modal', ['data' => $article, 'name' => 'articles'])--}}
					@endif
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($articles) !!}
	</div>
@stop
