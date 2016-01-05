@extends("frontend.layouts.master_v2")

@section("contents")
    <ul class="unstyled clearfix sort-nav" id="collection-categories-nav" data-js-module="collection-category" data-fetch-url="/recommendations/notes">
    </ul>
    <ul class="article-list thumbnails">
        @foreach($articles as $item)
        <li class="have-img">
            @if(!empty($item['thumbnail-image']))
            <a class="wrap-img" href="/article/{{ $item['id'] }}"><img src="/images/demo/1.png" alt="300"></a>
            @endif
            <div>
                <p class="list-top">
                    <a class="author-name blue-link" target="_blank" href="/article/list/{{ $item['category'] }}">{{ $item['category'] }}</a>
                    <em>·</em>
                    <span class="time" data-ctime="{{ $item['created_at'] }}">{{ ViewHelper::timeFormat($item['created_at']) }}</span>
                </p>
                <h4 class="title"><a class="title-gray" href="/article/{{ $item['id'] }}">{{ $item['title'] }}</a></h4>
                <div class="list-footer">
                    <a target="_blank" href="javascript:void 0;">
                        阅读 0
                    </a>
                    <a target="_blank" href="javascript:void 0;">
                        · 评论 暂无评论
                    </a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {!! ViewHelper::pagination($page, $maxPage) !!}
    {{--<div class="pagination">--}}
        {{--<a href="http://ymblog.net/">最前</a>--}}
        {{--<a href="http://ymblog.net/page/6/">上一页</a>--}}
        {{--<a href="http://ymblog.net/page/5/" class="inactive">5</a>--}}
        {{--<a href="http://ymblog.net/page/6/" class="inactive">6</a>--}}
        {{--<span class="current">7</span>--}}
    {{--</div>--}}
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.currentPage = 'article-timeline';
    </script>
    {!! ViewHelper::registerRequirejs('app/v2') !!}
@stop