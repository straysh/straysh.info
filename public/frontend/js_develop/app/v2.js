require(['jquery', 'UI', 'libs/highlight.min'
],
function($, UI, hljs) {
    hljs.configure({
        tabReplace: '    '
    });
    hljs.initHighlightingOnLoad();
    $().ready(function(){
        var left = $('.navbar-jianshu').width();
        var $leftAside = $('.left-aside');
        //$('body').css({paddingLeft: left});
        //$leftAside.css({left: left});
        if($('.page-title').is(':visible')) $('.right-aside').css({marginLeft: $leftAside.width()});
    });
});