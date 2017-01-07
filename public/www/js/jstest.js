define(['jquery', 'imagesLoaded'], function($){
    var Jstest = {
        imagesDelayLoad: imagesDelayLoad
    };

    function imagesDelayLoad(){
        var $wait = $('#waritfor-loadng-js'),
            src = $wait.data('src');
        $wait[0].src = src;
        imagesLoaded($wait, function(){
            console.log('loaded');
        });
    }

    return function(){
        return Jstest;
    };
});