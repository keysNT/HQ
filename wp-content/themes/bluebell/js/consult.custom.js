(function($) {

    "use strict";

    var BB = {};
    var $window = $(window);

    BB.menu_desktop = function() {
        /*menu*/
        $('.menu-item-has-children').hover(function() {
            var submenu = $(this).children('ul.sub-menu');
            submenu.slideDown(200, function() {
                $(this).clearQueue();
            });

        }, function() {
            var submenu = $(this).children('ul.sub-menu');
            submenu.slideUp(500, function() {
                $(this).clearQueue();
            });
        });
    }
    BB.menu_mobile = function() {
        $('.left-sidebar').fadeOut();
        $('.btn-left-sidebar').toggle(function() {
            $(this).addClass('btn-active');
            $('.left-sidebar').addClass('menu_mobile_open')
        }, function() {
            $(this).removeClass('btn-active');
            $('.left-sidebar').removeClass('menu_mobile_open')
        });
    }
    BB.accordion = function(){
        $('.toggle').on('click', function(e) {
            e.preventDefault();
          
            var $this = $(this);
          
            if ($this.next().hasClass('show')) {
                $this.removeClass('acc_active');
                $this.next().removeClass('show');
                $this.next().slideUp(350);
            } else {
                $this.parent().parent().find('span.toggle').removeClass('acc_active');
                $this.toggleClass('acc_active');
                $this.parent().parent().find('li .inner').removeClass('show');
                $this.parent().parent().find('li .inner').slideUp(350);
                $this.next().toggleClass('show');
                $this.next().slideToggle(350);
            }
        });
    }
    BB.tabs = function(){
        $('.bb-nav a').on('click', function(e) {
            $(this).addClass('current-tabs').siblings().removeClass('current-tabs');
            // target element id
            var id = $(this).attr('href');
            /*find indexOf #*/
            var c = id.indexOf("#");
            /*remove string: start 0 end #*/
            var r = id.substr(c);
            // target element
            var $id = $(r);
            if ($id.length === 0) {
                return;
            }
            // prevent standard hash navigation (avoid blinking in IE)
            e.preventDefault();
            $id.css('display', 'block').siblings().css('display', 'none');
        });
    }
    BB.httabs = function(){
        var url      = window.location.href;
        var x = url.indexOf("#");
        // var $hello = $('.bb-nav').find('.current-tabs').attr('href');
        
        if(x <= 0){return;}
        var y = url.substr(x);
        var $z = $(y);



        $(y).css('display', 'block').siblings().css('display', 'none');        
        $('.bb-nav a[href^="'+ y +'"]').addClass('current-tabs').siblings().removeClass('current-tabs');
    }

    $(document).ready(function() {
        BB.menu_desktop();
        BB.menu_mobile();
        BB.accordion();
        // BB.tabs();
    });
    $(window).load(function(){
        BB.httabs();
    });

})(jQuery);
