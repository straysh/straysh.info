define(['jquery'], function($){
//    var back2top;
//    var config;
//    var $el;
//
//    back2top = {
//        init: function(cfg){
//            config = $.extend(config, cfg);
//            run();
//            $(window).scroll(function(){
//                ScrollStart();
//                ScrollDone();
//            });
//        }
//    };
//
//    function run(){
//        pos();
//        draw();
////		show();
//    }
//
//    function foo(){
//        alert(1);
//    }
//
//    function pos(){
//        config.pos = {};
//        config.pos.h = $(window).scrollTop() + $(window).height()/2;
//    }
//
//    function ScrollStart(){
//        if($(window).scrollTop()>0)
//            show();
//        else
//            hide();
//        config.pos.h = $(window).scrollTop() + $(window).height()/2;
//        $el.css({top: config.pos.h});
//    }
//
//    function ScrollDone(){
//        ;
//    }
//
//    function show(){
//        $('body').append($el.show());
//    }
//
//    function hide(){
//        $el.hide();
//    }
//
//    function draw(){
//        var bar = $('<a href="#top" class="back2top" unselectable="on" onselectstart="return false;">Back to Top</a>');
//        bar.css({display:'none'});
//        bar.css({position:'absolute', top:config.pos.h, right:'5px'});
//        $el = bar;
//    }
//
//    $.Back2Top = back2top;
    return function(){
        console.log('back2top');
    }
});