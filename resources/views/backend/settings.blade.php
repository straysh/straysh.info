@extends($layout)

@section('content-header')
	<h1>
	Settings
	</h1>
@stop

@section('content')

<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#general" data-toggle="tab">General</a></li>
	<li><a href="#data" data-toggle="tab">Data</a></li>
	<li><a href="#social" data-toggle="tab">Social Media</a></li>
	<li><a href="#seo" data-toggle="tab">SEO</a></li>
	<li><a href="#analytics" data-toggle="tab">Analytics</a></li>
	<li><a href="#backup" data-toggle="tab">Cache And Reset</a></li>
	<li><a href="#developers" data-toggle="tab">Developers</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="general">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
			<div class="form-group">
				<label for="site_name">Site Name:</label>
				<input class="form-control" type="text" name="site_name" id="site_name" value="{!! option('site.name') !!}">
				{!! $errors->first('site_name', '<div class="text-danger">:message</div>') !!}
			</div>
			<div class="form-group">
				<label for="site.slogan">Slogan:</label>
				<input class="form-control" type="text" name="site.slogan" id="site.slogan" value="{!! option('site.slogan') !!}">
				{!! $errors->first('site.slogan', '<div class="text-danger">:message</div>') !!}
			</div>
			<div class="form-group">
				<label for="site.description">Description:</label>
				<input class="form-control" type="text" name="site.description" id="site.description" value="{!! option('site.description') !!}">
				{!! $errors->first('site.description', '<div class="text-danger">:message</div>') !!}
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" value="Save">
			</div>
		</form>
	</div>
	<div class="tab-pane" id="data">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
		<div class="form-group">
            <label for="pagination.perpage">Pagination Per Page:</label>
            <input class="form-control" type="text" name="pagination.perpage" id="pagination.perpage" value="{!! option('pagination.perpage') !!}">
			{!! $errors->first('pagination.perpage', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Save">
		</div>
		</form>
	</div>
	<div class="tab-pane" id="developers">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
		<div class="form-group">
            <label for="ckfinder.prefix">CKFinder Prefix Path:</label>
            <input class="form-control" type="text" name="ckfinder.prefix" id="ckfinder.prefix" value="{!! option('ckfinder.prefix') !!}">
			{!! $errors->first('ckfinder.prefix', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group hidden">
            <label for="admin.theme">Admin Theme:</label>
            <input class="form-control" type="text" name="admin.theme" id="admin.theme" value="{!! option('admin.theme') !!}">
			{!! $errors->first('admin.theme', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Save">
		</div>
		</form>
	</div>
	<div class="tab-pane" id="backup">
		<h3></h3>
		@if(defined("STDIN"))
		<p>
			{!! modal_popup(route('admin.reinstall'), 'Reinstall Website', 'Anda yakin ingin menginstall ulang website ini ?')!!}
		</p>
		<p>
			{!! modal_popup(route('admin.cache.clear'), 'Clear Cache', 'Anda yakin ingin menghapus cache?')!!}
		</p>
		@else
		<div class="alert alert-warning">
			<p>
				Sorry, your server is not support artisan via interface.
			</p>
		</div>
		@endif
	</div>
	<div class="tab-pane" id="seo">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
		<div class="form-group">
            <label for="site.keywords">Keyword:</label>
            <input class="form-control" type="text" name="site.keywords" id="site.keywords" value="{!! option('site.keywords') !!}">
			{!! $errors->first('site.keywords', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
            <label for="post.permalink">Post Permalink:</label>
            <input class="form-control" type="text" name="post.permalink" id="post.permalink" value="{!! option('post.permalink') !!}">
			{!! $errors->first('post.permalink', '<div class="text-danger">:message</div>') !!}
			<p class="help-block">Permalink URL for article or page.</p>
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Save">
		</div>
		</form>
	</div>
	<div class="tab-pane" id="social">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
		<div class="form-group">
            <label for="facebook.link">Facebook Link:</label>
            <input class="form-control" type="text" name="facebook.link" id="facebook.link" value="{!! option('facebook.link') !!}">
			{!! $errors->first('facebook.link', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
            <label for="twitter.link">Twitter Link:</label>
            <input class="form-control" type="text" name="twitter.link" id="twitter.link" value="{!! option('twitter.link') !!}">
			{!! $errors->first('twitter.link', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Save">
		</div>
		</form>
	</div>
	<div class="tab-pane" id="analytics">
		<h3></h3>
		<form action="{{ $currentUrl }}" method="POST">
		<div class="form-group">
            <label for="tracking">Tracking Script:</label>
            <input class="form-control" type="text" name="tracking" id="tracking" value="{!! option('tracking') !!}">
			{!! $errors->first('tracking', '<div class="text-danger">:message</div>') !!}
			<p class="help-block">
				To append this script just add : <span class="muted">@{!! option('tacking') !!}</span> on your view.
			</p>
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Save">
		</div>
		</form>
	</div>
</div>

@stop
