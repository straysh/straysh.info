define(['zepto', 'UI'/*, 'iscroll'*/],
function(Zepto, UI/*, IScroll*/){

    function Waterfall(){
        //this.iscroll = void 0;
        this.ajaxRequesting = false;
        this.scrollEnd = false;
        this.maxRetryTimes = 3;
        this.retries = 0;
        this.page = 1;
        this._params = {};
        this.mask = void 0;
    }

    Waterfall.prototype.init = function(params, options){
        var self = waterfall;
        self.el = params.el || '#wrapper';
        self.retries = 0;
        self.maxRetryTimes = params.maxRetryTimes || self.maxRetryTimes;
        self.render = params.render || function(){};
        self._params = params;
        self.__pollScroll();
        self.generateMask();
        return self;
    };

    Waterfall.prototype.checkScroll = function() {
        var self = waterfall;
        if (self.scrollEnd) {
            return;
        }
        if (!self.lowEnough()) {
            return self.__pollScroll();
        }
        self.requestData();
    };
    Waterfall.prototype.__pollScroll = function(){
        setTimeout(this.checkScroll, 100);
    };
    Waterfall.prototype.lowEnough = function () {
        return $(window).scrollTop() && ( $(document).height() - $(window).scrollTop() - $(window).height() < 200 );
    };

    Waterfall.prototype.requestData = function(){
        var self = this, ajaxParams=self._params;
        if(self.ajaxRequesting) return;
        self.ajaxRequesting = true;
        self.startLoadingAnimation();
        $.ajax({
            url: ajaxParams.url,
            type: ajaxParams.type || 'post',
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': UI.$CONFIG.__token},
            data: $.extend({}, {page: ++self.page}, ajaxParams.data)
        }).done(function(response){
            if(!response || response.status>10000){
                return self.retry();
            }
            if(!response.data.length){
                self.noMoreData();
                return self.scrollEnd = true;
            }
            self.done(response.data);
            self.stopLoadingAnimation();
            setTimeout(function () {
                //self.iscroll.refresh();
                self.ajaxRequesting = false;
                self.__pollScroll();
            }, 100);
        });
    };

    Waterfall.prototype.startLoadingAnimation = function(){
        this.mask.show();
    };
    Waterfall.prototype.stopLoadingAnimation = function(){
        this.mask.hide();
    };
    Waterfall.prototype.generateMask = function(){
        var $mask = $('#mask');
        if(!$mask.length)
        {
            $mask = $(_.template($('#mask-tpl').html(), {text:'加载中...'})).hide();
            $('body').append($mask);
        }
        this.mask = $mask;
    };
    Waterfall.prototype.noMoreData = function(){
        console.log("no more data");
    };
    Waterfall.prototype.retry = function(){
        var self = this;
        if(++self.retries > self.maxRetryTimes){
            self.scrollEnd = true;
            return self.error = '重试次数超出限制';
        }
        self.requestData(--self.page);
    };
    Waterfall.prototype.done = function(data){
        this.render(data);
        return self;
    };

    var waterfall = new Waterfall();
    return {init: waterfall.init};
});