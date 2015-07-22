define(['jquery', 'backbone'], function($){
    function ArticleMenus(){
        this.menusTree = void 0;
        this.menusTreeOpened = false;
        this.disableMenusTree = false;
        this.init();
    }

    ArticleMenus.prototype.init = function(){
        this.$nav = $('.site-navigation');
        this.height = this.$nav.outerHeight();
        this.width = this.$nav.outerWidth();
        this.drawToggleButton();
    };

    ArticleMenus.prototype.drawToggleButton = function(){
        var self = this,
            $button = $('<div></div>').css({
            zIndex: 1001,
            backgroundColor: '#bcc',
            cursor: 'pointer',
            width: '20px',
            height: '40px',
            lineHeight: '40px',
            padding: '5px 10px',
            position: 'fixed',
            bottom: '20%',
            left: self.width
        }).html('>>');
        $button.on("click", function(){
            self.menusTreeOpened = !self.menusTreeOpened;
            if(self.menusTreeOpened){
                $button.addClass("article-menu-open").html('<<');
                self.openMenusTree();
            }else{
                $button.removeClass("article-menu-open").html('>>');
                self.closeMenusTree();
            }
        });
        if(!self.menusTree) self.drawMenusTree();
        if(self.disableMenusTree) return;
        $('body').append($button);
    };

    ArticleMenus.prototype.openMenusTree = function(){
        this.menusTree.show();
    };

    ArticleMenus.prototype.closeMenusTree = function(){
        this.menusTree.hide();
    };

    ArticleMenus.prototype.drawMenusTree = function(){
        var self = this,
            $tree = $('<div></div>').css({
                zIndex: 1000,
                position: 'fixed',
                top: 0,
                left: 0,
                width: self.width - 25,
                height: self.height,
                padding: '10px 0 10px 20px',
                display: 'none'
            });

        $tree.empty().append(self.parseMenusTree());

        this.menusTree = $tree;
        $('body').append($tree);
    };

    ArticleMenus.prototype.parseMenusTree = function(){
        var $article = $('article');
        var h1s = [];
        $article.find('h1').each(function(i){
            var $item = $(this);
            $item.attr({id: 'treeNode'+i});
            h1s.push({
                id: 'treeNode'+i,
                html: $item.html()
            });
        });
        if(!h1s.length) return this.disableMenusTree = true;
        var tree = _.template($('#articleMenuTree-tpl').html(), {h1s: h1s});
        return $(tree);
    };

    return new ArticleMenus();
});