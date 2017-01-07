<!doctype html>
<html lang="en">
<head>
    @include("www.layouts._partial.head")
    @section('head')
        @if(config('app.debug'))
            {!! ViewHelper::registerCssScript('app') !!}
            {!! ViewHelper::registerCssScript('test') !!}
        @else
            {!! ViewHelper::registerCssScript('app') !!}
        @endif
    @show
</head>
<body class="{{ $bodyClass or "output" }}" id="{{ $bodyId or "main-container" }}" role="main" ontouchstart="" data-ctrl-name="pageview" data-dpr="2" >
@yield("contents")

@section("modal")
    {!!
        ViewHelper::registerJsTemplate([

        ])
    !!}

    <script>
        var UI = window.UI || {};
        UI.$CONFIG = UI.$CONFIG || {};
        UI.api_host = '{{ ViewHelper::apiHost() }}';
        UI.web_host = '{{ ViewHelper::webHost() }}';
        UI.$CONFIG.Yuser = ({!! ViewHelper::json_encode(isset($yuser)?$yuser:[]) !!});
        UI.$CONFIG.Ouser = ({!! ViewHelper::json_encode(isset($ouser)?$ouser:[]) !!});
        UI.$CONFIG.pageParams = ({!! ViewHelper::json_encode(isset($pageParams)?$pageParams:[]) !!});
        UI.$CONFIG.singPack = ({!! ViewHelper::json_encode(isset($singPack)?$singPack:[]) !!});
    </script>
    @if(!config('app.debug'))
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?05a9120284c9d52abbb86d83442f5413";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    @endif
@show
</body>
</html>