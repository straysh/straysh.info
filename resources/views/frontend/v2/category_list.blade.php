@extends("frontend.layouts.master_v2")

@section("contents")
    <ul class="unstyled clearfix sort-nav" id="collection-categories-nav" data-js-module="collection-category" data-fetch-url="/recommendations/notes">
    </ul>
    <ul class="article-list thumbnails">
        <li class="have-img">
            <a class="wrap-img" href="/p/95272fe1e122"><img src="/images/demo/1.png" alt="300"></a>
            <div>
                <p class="list-top">
                    <a class="author-name blue-link" target="_blank" href="/users/1441f4ae075d">彭小六</a>
                    <em>·</em>
                    <span class="time" data-shared-at="2015-12-27T23:47:43+08:00">大约15小时之前</span>
                </p>
                <h4 class="title"><a class="title-gray" target="_blank" href="/p/95272fe1e122">写作有什么难？！用三张便签快速练成“干货写手”</a></h4>
                <div class="list-footer">
                    <a target="_blank" href="javascript:void 0;">
                        阅读 6954
                    </a>
                    <a target="_blank" href="javascript:void 0;">
                        · 评论 暂无评论
                    </a>
                </div>
            </div>
        </li>
    </ul>
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.currentPage = 'homepage';
    </script>
    {!! ViewHelper::registerRequirejs('app/theme') !!}
@stop