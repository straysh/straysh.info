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
      webHost: ({!! json_encode($webHost??'') !!}),
      apiHost: ({!! json_encode($apiHost??'/api') !!})
    };
  </script>
</head>
<body>
<div id="app"></div>
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
