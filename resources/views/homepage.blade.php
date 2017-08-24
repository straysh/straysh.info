<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $pageTitle or 'Straysh的后院' }}</title>
  <meta name="csrf-token" content="{{ $csrf_token }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script>
    window.UI = {
      api_version: '{{ env("MINIMAL_SDK_VERSION") }}',
      pageParams: ({!! json_encode($pageParams??[]) !!}),
      Yuser: ({!! json_encode($yuser??[]) !!}),
      singPack: ({!! json_encode($singPack??[]) !!}),
      webHost: ({!! json_encode($webHost??'/admin') !!}),
      apiHost: ({!! json_encode($apiHost??'/api') !!})
    };
  </script>
</head>
<body>
<div class="container-fluid">
  <div class="navbar navbar-jianshu expanded">
    <div class="dropdown">
      <a class="active logo" href="/">
        <b>S</b>{{--<i class="fa fa-home hidden"></i>--}}<span class="title hidden">首页</span>
      </a>
      <a href="javascript:void 0;">
        <i class="fa fa-th"></i><span class="title hidden">Category</span>
      </a>
    </div>
    <div class="nav-user">
      {{--<a href="#view-mode-modal" data-toggle="modal"><i class="fa fa-font"></i><span class="title">显示模式</span></a>--}}
      <a class="signin" href="javascript:void 0;">
        <i class="fa fa-sign-in"></i><span class="title hidden">登录</span>
      </a>
    </div>
  </div>
  //导航栏s
  //内容区
</div>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
