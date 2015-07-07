require.config({
    baseUrl: '/js',
    paths: {
        jquery: 'libs/jquery-1.9.0',
        imagesLoaded: 'libs/imagesloaded.pkgd'
    }
});

require(['jquery', 'libs/highlight.pack', 'back2top', 'disqus', 'jstest' ],
function($, hljs, back2top, disqus, jstestModule){
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