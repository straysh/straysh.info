@extends("www.layouts.master_v2")

@section("contents")
    {!! $crumbs !!}
    {!! $summary !!}
    {!! $articles !!}
    @include("www.layouts._partial.footer", ['hr'=>false])
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.currentPage = 'category';
    </script>
    {!! ViewHelper::registerRequirejs('app/v2') !!}
@stop