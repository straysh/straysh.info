__Straysh的个人博客__ » [首页][1] » [{{ $category->name }}][2]

[1]:{{ $homeurl }} "Straysh的个人博客"
[2]:/article/{{ $category->name }} "{{ $category->name }}"

<form action="/search" class="header-search pull-left hidden-sm hidden-xs" onclick="alert('not implemented yet!');return false;">
    <button type="submit" class="btn btn-link"><span class="sr-only">搜索</span><span class="glyphicon glyphicon-search"></span></button>
    <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="" style="width: 180px;">
</form>