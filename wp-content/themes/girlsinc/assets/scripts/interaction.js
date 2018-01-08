(function ($) {

    var scrollLoc = $("body, html").scrollTop();

    $(window).load(function() {
        titleAnimation();
        heroAnimation(scrollLoc);
    });

    $(window).scroll(function() {
        scrollLoc = $("body, html").scrollTop();

        titleAnimation();
        heroAnimation(scrollLoc);
    });

    function titleAnimation() {
        $(".girlsinc-title-ui").each(function(index) {
            var thisEl = $(this);
            if(verge.inViewport(thisEl)) {
                thisEl.addClass('active-title');
            }
        });
    }

    function heroAnimation(scroll) {
        var bgSizeInitial = scroll * .2;
        var bgSizeFinal = 100 + bgSizeInitial;

        $('.page-header').each(function() {

           $(this).css({'background-size': bgSizeFinal + '%'});

           $(this).children('.header-content').css({
              'top': '-' + scroll / 2 + 'px'
           });

           if(scroll % 20 == 0) {
               //console.log(scroll);

               var blurAmount = scroll / 20;
               $(this).css({
                   'filter': 'blur(' + blurAmount + 'px)',
                   '-webkit-filter': 'blur(' + blurAmount + 'px)',
                   '-ms-filter:': 'blur(' + blurAmount + 'px)'
               });
           }
        });
    }


})(jQuery);