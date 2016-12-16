@extends("frontend.layouts.master_v2")

@section("contents")
    @if(isset($items))
        <ul>
            @foreach($items as $item)
                <a href="/essay/price-watcher?item_id={{ $item->id }}"><li>{{ $item->name }}</li></a>
            @endforeach
        </ul>

        <form class="dev-box" action="/essay/price-watcher" method="POST" style="position: fixed;bottom: 10px;width: 90%;">
            <fieldset>
                <legend>跟踪商品</legend>
                商品名:<input type="text" name="name" placeholder="商品名" style="width: 50%;"><br><br>
                原始地址:<input type="text" name="raw_url" placeholder="原始地址" style="width: 50%;"><br><br>
                查询地址:<input type="text" name="watch_url" placeholder="查询地址" style="width: 50%;"><br><br>
                <textarea name="desc" placeholder="说明" rows="5" style="width: 90%;"></textarea><br><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="提交">
            </fieldset>
        </form>
    @else
    <h1>Chart</h1>
    @if(isset($item))
        <div style="color: #333333; font-size: 16px; margin: 10px; text-align: center; font-weight:bold;">{{ $item->name }}</div>
    @endif
    <div style="height: 420px;width:950px;font-size: 12px;position: relative;">
        <div id="chart-container" style="width: 950px; height: 420px; margin: 0 auto; font-size:12px;"></div>
    </div>
    @endif
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.chart_data = '{{ isset($data) ? $data : "" }}';
    </script>
    {!! ViewHelper::registerRequirejs('app/price_watcher') !!}
@stop