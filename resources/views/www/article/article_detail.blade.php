@extends("www.layouts.master_v2")

@section("contents")
    {!! $crumbs !!}
    {!! $summary !!}
    {!! $articles !!}
    @include("www.layouts._partial.footer")
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.currentPage = 'article-detail';
    </script>
    {!! ViewHelper::registerRequirejs('app/v2') !!}
@stop