__Straysh的个人博客__ » [首页][1] » [{{ $category->name }}][2]

[1]:{{ $homeurl }} "Straysh的个人博客"
[2]:/article/list/{{ $category->name }} "{{ $category->name }}"

<form action="/search" class="header-search">
    <button type="submit" class="btn btn-link"><span class="sr-only hidden">搜索</span><span class="fa fa-search"></span></button>
    <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="" style="width: 180px;" onfocus="$(this).stop().animate({width: '300px'});" onblur="$(this).stop().animate({width:'180px'});">
</form>