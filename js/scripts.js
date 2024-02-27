(function () {
    "use strict";

    var $window, $document, $body;

    $window = $(window);
    $document = $(document);
    $body = $("body");


    /*==============================================
     Pre loader init
     ===============================================*/

    var $portfolio = $('.portfolio').masonry({
        itemSelector: '.portfolio-item',
    });

    if ($('.ajaxloadpost .next').length > 0) {
        var masonry = $portfolio.data('masonry');
        $portfolio.infiniteScroll({
            path: '.next',
            append: '.portfolio-item',
            hideNav: '.ajaxloadpost',
            status: '.page-load-status',
            history: false,
            scrollThreshold: 100,
            outlayer: masonry
        });

        $('.portfolio').on('append.infiniteScroll', function () {
            $("img.lazyload").lazyload({
                onLoaded: lazyloaded
            });
        });
    }

    function lazyloaded() {
        $portfolio.masonry('layout');
    }

    $window.on("load", function () {
        $("#loading").fadeOut();
        $("#tb-preloader").delay(200).fadeOut("slow").remove();
        $("img.lazyload").lazyload({
            onLoaded: lazyloaded
        });
        $(".js-primary-navigation").menuzord();
    });

    /*==============================================
     Wow init
     ===============================================*/
    if (typeof WOW == "function")
        new WOW().init();
})(jQuery);