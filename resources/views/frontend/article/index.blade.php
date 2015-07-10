@extends("frontend.layouts.master")

@section('head')
    <link rel="stylesheet" href="/css/highlight/shCore.css">
@stop

@section("content")
    {!! $crumbs !!}
    {!! $summary !!}
    {!! $articles !!}
@stop