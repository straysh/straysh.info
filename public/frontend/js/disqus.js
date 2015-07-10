define(['jquery'], function($){
    var UI = {};
    function lowEnough() {
        var scrollH	=	$(window).scrollTop();
        var viewH	=	$(window).height();
        var limit	=	$('#site-footer').position().top-20;
        return (viewH+scrollH) >= limit && !UI.disqusLoaded;
    }
    function checkScroll() {
        if (!lowEnough()) {
            return __pollScroll();
        }
        UI.disqusLoaded=true;
        activateDisqus();
    }
    function __pollScroll() {
        if(!$('#disqus_thread').length){
            return UI.disqusLoaded = true;
        }
        setTimeout(checkScroll, 100);
    }
    function activateDisqus(){
        var disqus_shortname = 'straysh'; // Required - Replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    }
    return __pollScroll;
});