@extends("www.layouts.master")

@section("content")
{!! $crumbs !!}
{!! $summary !!}
{!! $articles !!}
@stop

@section("foot")
    @parent

    {!!
        ViewHelper::registerJsTemplate([
            "articleMenuTree"
        ])
    !!}
@stop