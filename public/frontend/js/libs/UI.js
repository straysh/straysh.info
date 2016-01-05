define(['jquery', 'backbone'
    ],
function($){
    var UI = window.UI || {};
    window.UI = UI;
    UI.t = function(str){
        return str;
    };
    UI.useTB = false;
    UI.events = [];
    UI.eventsOnce = {};
    UI.$CONFIG = UI.$CONFIG || {};
    UI.$CONFIG.__token = UI.$CONFIG.__token || void 0;
    UI.$CONFIG.Yuser = UI.$CONFIG.Yuser || {};
    UI.$CONFIG.Ouser = UI.$CONFIG.Ouser || {};
    UI.$CONFIG.singPack = UI.$CONFIG.singPack || {};
    UI.$CONFIG.pageParams = UI.$CONFIG.pageParams || {};

    UI.api_host = UI.api_host || 'http://api.lifemenu.com.cn';
    UI.web_host = UI.web_host || 'http://www.lifemenu.com.cn';
    UI.static_host = UI.static_host || 'http://static.lifemenu.com.cn';

    UI.isGuest = function(){
        return UI.$CONFIG.Yuser && UI.$CONFIG.Yuser.hasOwnProperty('isGuest') && !UI.$CONFIG.Yuser.isGuest ?
            false : true;
    };

    /**
     * 根据ajax返回的errorCode，给出合适的错误提示
     */
    UI.listenError = function (errorCode, error, callback) {
        callback = (callback && typeof callback === 'function') ? callback : void(0);
        switch (errorCode) {
            case 10006:
                if(callback){
                    console.info('callback invoking not implemented');
                }
                UI.publish('login.user');
                break;
            default:
                error ? UI.infoError(error) : null;
                break;
        }
    };

    UI.unsubscribe = function(eventName){
        for(var j in UI.eventsOnce){
            if(eventName===j){ delete UI.eventsOnce[j];break; }
        }

        for(var i in UI.events){
            if(eventName===UI.events[i]){ UI.events.splice(i, 1);break; }
        }
        Backbone.off(eventName);

        return UI;
    };

    UI.subscribe = function(eventName, handler, context){
        UI.events.push(eventName);
        context ?
        Backbone.on(eventName, function(){handler.apply(context, arguments)}) :
        Backbone.on(eventName, handler);

        return UI;
    };

    UI.once = function(eventName, handler, context){
        for(var i in UI.eventsOnce)
            if(eventName===i && !UI.eventsOnce[i]){return;}
        UI.events.push(eventName);
        UI.eventsOnce[eventName] = 0;
        context ?
        Backbone.once(eventName, function(){handler.apply(context, arguments)}) :
        Backbone.once(eventName, handler);

        return UI;
    };

    UI.publish = function(eventName, data){
        data = data || {};
        var invoke=false;
        for(var j in UI.eventsOnce){
            if(eventName===j && !UI.eventsOnce[j]){ invoke=true; }
            if(eventName===j){ UI.eventsOnce[j]=1; }
        }

        for(var i in UI.events){
            if(invoke){ UI.events.splice(i, 1); }
            if(eventName===UI.events[i]){ invoke=true;break; }
        }

        if(!invoke){ return console.info(eventName+' not caught!'); }
        Backbone.trigger(eventName, data);

        return UI;
    };

    UI.publishOnce = function(eventName, data){
        var invoke=false;
        for(var j in UI.eventsOnce){
            if(eventName===j){
                if(!UI.eventsOnce[j]) invoke=true;
                else return "already triggered";
            }
            UI.eventsOnce[j]=1;
        }

        for(var i in UI.events){
            if(eventName===UI.events[i]&&invoke){
                UI.events.splice(i, 1);
                break;
            }
        }

        if(!invoke){ return console.info(eventName+' not caught!'); }
        Backbone.trigger(eventName, data);

        return UI;
    };

    /**
     * 订阅未登录
     */
    UI.subscribe("login.user", function(){
        UI.info('请先登陆', 0);
    });

    /**
     * 清空输入框
     */
    UI.clearInput = function($input){
        $input.find("textarea")[0].value = "";
        return $input;
    };

    /**
     * loading动画
     */
    UI.loadingAnimation = function($container, large){
        large = typeof large === 'undefined' ? false : large;
        var className = large ? 'loading-lg' : 'loading-sm';
        var $loading = $('<div class="loading"><i class="fa fa-spinner fa-spin"></i></div>').addClass(className);
        $container.empty().append($loading);
    };

    /**
     * 检查target节点是否在container节点内部(含边界)
     * deep是递归的深度，例如container的树形有4层，则deep=5;
     */
    UI.isInnerContainer = function(target, container, deep){
        deep = deep || 1;
        for(var i=0;i<deep;i++){
            var _target = target;
            for(var j=0;j<i;j++) if(_target.parentNode) _target = _target.parentNode;
            if(_target === container) return true;
        }
    };

    UI.date = {
        ago: function(t){
            t = t ? new Date(t) : new Date();
            var diff = (((new Date()).getTime() - t.getTime()) / 1000);
            diff = diff > 0 ? diff : 0;
            var day_diff = Math.floor(diff / 86400);

            return day_diff == 0 &&
                (
                diff < 60 && "just now" ||
                diff < 120 && "1 minute ago" ||
                diff < 3600 && Math.floor( diff / 60 ) + "minutes ago" ||
                diff < 7200 && "1 hour ago" ||
                diff < 86400 && Math.floor( diff / 3600 ) + " hours ago"
                ) ||
                day_diff == 1 && "Yesterday" ||
                day_diff < 7 && day_diff + " days ago" ||
                Math.ceil( day_diff / 7 ) + " weeks ago";
        },

        currentDate: function(t){
            var monthNamesLong = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];
            var monthNamesShort = [
                "Jan", "Feb", "Mar",
                "Apr", "May", "June", "July",
                "Aug", "Sep", "Oct",
                "Nov", "Dec"
            ];

            var date = t ? new Date(t) : new Date();
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            return day + ' ' + monthNamesShort[monthIndex] + ', ' + year;
        },

        chatTime: function(t){
            t = new Date(t);
            var day = t.getDate();
            var month = t.getMonth()+1;
            var year = t.getFullYear();
            var hour = t.getHours();
            var min = t.getMinutes();
            var sec = t.getSeconds();

            return year +'-'+ month +'-'+ day +' '+ hour +':'+ min +':'+ sec;
        }
    };

    UI.currentDate = function(t){
        var monthNamesLong = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];
        var monthNamesShort = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "June", "July",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var date = t ? new Date(t) : new Date();
        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        return day + ' ' + monthNamesShort[monthIndex] + ', ' + year;
    };

    /**
     * 锁屏
     */
    UI.lockScreen = function(){
        var $mask = $('<div></div>').css({
            width: '100%',
            height: '100%',
            opacity: 0.5,
            background: '#ccc',
            position: 'absolute',
            top: 0,
            left: 0
        });
        $('body').append($mask).addClass('modal-open');
    };

    /**
     * 检查节点是否是input:text 或者 textarea
     */
    UI.__isEditable = function($node){
        var tagname = $node[0].tagName.toLowerCase();
        return !('input' !== tagname && 'textarea' !== tagname);
    };

    /**
     * 高亮关键字
     */
    UI.hightlight = function(str, term, opts){
        var pattern = new RegExp('('+term+')', 'gi');
        return str.replace(pattern, "<b>$1</b>");
    };

    return UI;

});