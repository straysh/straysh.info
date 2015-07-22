require.config({
    baseUrl: '/js',
    paths: {
        jquery: 'libs/jquery-1.9.0',
        backbone: "libs/backbone/backbone",
        underscore: "libs/underscore/underscore",
        imagesLoaded: 'libs/imagesloaded.pkgd'
    },
    shim: {
        backbone: {
            deps: ["underscore"],
            exports: "Backbone"
        }
    }
});

require(['jquery', 'libs/highlight.pack', 'back2top', 'modules/articleMenus', 'disqus', 'jstest' ],
function($, hljs, back2top, articleMenus, disqus, jstestModule){
    hljs.configure({
        tabReplace: '    '
    });
    hljs.initHighlightingOnLoad();
    back2top();
    setTimeout(function(){
        disqus();
    }, 3000);
    jstestModule();
});