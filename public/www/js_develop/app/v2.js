require(['jquery', 'UI', 'libs/highlight.min'
],
function($, UI, hljs) {
    hljs.configure({
        tabReplace: '    '
    });
    hljs.initHighlightingOnLoad();
});