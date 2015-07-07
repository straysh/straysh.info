@extends("layouts.master")

@section("content")
    {!! ViewHelper::articleMarkdownParser($category) !!}
    {!! ViewHelper::articleSummary($category) !!}
    {!! ViewHelper::articleList($articles) !!}
@stop