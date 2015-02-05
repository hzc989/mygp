$(document).ready(function() {
    $('.js_bind_hover').each(function() {
        var e = $(this);
        e.bind('click', function() {
            if (e.hasClass('hover')) {
                e.removeClass('hover');
            } else {
                e.addClass('hover');
            }
        });
        e.hover(function(event) {
            setTimeout(function() {
                e.addClass('hover');
            }, 15);
        }, function() {
            setTimeout(function() {
                e.removeClass('hover');
            }, 20);
        }).find('a').bind('click', function(event) {
            e.removeClass('hover');
            event.stopPropagation();
        });
    });
});

jQuery.setTimeout = function(expression, timeout) {
    if (typeof expression == "function") {
        var $this = arguments[2];
        var $arguments = Array.prototype.slice.call(arguments, 3);
        var $expression = function() {
            expression.apply($this, $arguments);
        };
        return window.setTimeout($expression, timeout);
    } 
    else
        return window.setTimeout(expression, timeout);
};
(function($) {
    $.popup = {defaults: {message: "",type: "information",timeout: -1,effect: "slide",template: null},show: function(options) {
            if ($.popup.timeout != null) {
                window.clearTimeout($.popup.timeout);
                $.popup.timeout = null;
            }
            if (typeof options == "string")
                options = {message: options};
            var settings = $.extend({}, $.popup.defaults, options);
            if (settings.template == null) {
                var popup = "<table class='popup'><tr><td style='width:60px;text-align:right;vertical-align:middle;padding:10px'><img src='";
                if (settings.type == "information")
                    popup = popup + "img/information.gif";
                else if (settings.type == "warning")
                    popup = popup + "img/warning.gif";
                else
                    popup = popup + "img/error.png";
                popup = popup + "'></td><td class='popup-inner'>" + settings.message + "</td></tr></table>";
                $(".popup").remove();
                $("body").append(popup);
                settings.template = ".popup";
            } 
            else if (settings.message != "")
                $(settings.template + " .popup-inner").html(settings.message);
            var left = ($(window).width() - $(settings.template).width()) / 2;
            var top = ($(window).height() - $(settings.template).height()) / 2 - 60;
            if (left < 0)
                left = 0;
            if (top < 10)
                top = 10;
            $(settings.template).css({"left": left,"top": top,"opacity": 1.0,"display": "none"});
            $(settings.template).fadeIn("fast");
            if (settings.timeout > 0)
                $.popup.timeout = $.setTimeout($.popup.hide, settings.timeout, window, {effect: settings.effect,template: settings.template});
        },hide: function(options) {
            var settings = $.extend({}, $.popup.defaults, options);
            if (settings.template == null)
                settings.template = ".popup";
            if (settings.effect == "fade")
                $(settings.template).fadeOut("slow", function() {
                    $(this).hide();
                });
            else
                $(settings.template).animate({"left": 0,"opacity": 0.0}, "slow", "swing", function() {
                    $(this).hide();
                });
        },timeout: null}
})(jQuery);
