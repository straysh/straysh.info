@extends("frontend.layouts.master")

@section("content")
    @foreach($articles as $k=>$item)
        <timeline>
            <h1 class="justcenter">{{ $item->title }}</h1>
            @if(isset($item->link))
            原文: <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
            @endif
            <article>{!! ViewHelper::markdownParse($item->content) !!}</article>
        </timeline>
        @if( isset($articles[$k+1]) )
            <hr>
        @endif
    @endforeach
@stop

@section("footer")
@stop

@section("foot")
    @parent
@stop