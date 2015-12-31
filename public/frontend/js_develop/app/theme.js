require(['jquery', 'UI'
],
function($, UI) {
    $().ready(function(){
        var left = $('.navbar-jianshu').width();
        var $leftAside = $('.left-aside');
        $('body').css({paddingLeft: left});
        $leftAside.css({left: left});
        $('.right-aside').css({marginLeft: $leftAside.width()});
    });
});