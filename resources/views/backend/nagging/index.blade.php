@extends($layout)

@section('content-header')
	<h1>
		{!! $title or 'All Users' !!} ({!! $nagging->count() !!})
		&middot;
		<small>{!! link_to_route('nagging.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Content</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($nagging as $item)
			<tr>
				<td>{!! $item->id !!}</td>
				<td>{!! $item->content !!}</td>
				<td>{!! date('Y-m-d H:i:s', $item->created_at) !!}</td>
				<td class="text-center">
					<a href="{!! url('nagging/edit', $item->id) !!}">Edit</a>
					&middot;
					@include('backend.partials.markActive', ['data' => $item, 'name' => 'nagging'])
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@stop
