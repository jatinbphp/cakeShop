(function ($) {
    /*Add class current in menu*/
    $('ul .menu-item a').on('click',function() {
        $('.menu-item a').removeClass("current");
        $(this).addClass("current");
    });

    // Fancybox
    $('a.gallery-elements').fancybox({
        'transitionIn'  :   'elastic',
        'transitionOut' :   'elastic',
        'speedIn'       :   500,
        'speedOut'      :   500,
        'overlayShow'   :   false,
        'width'         : 700,
        'autoDimensions' : false,
        'centerOnScroll' : true
    });
    // End Fancybox

    /*Images Loader*/
    $(window).on('load', function() {
        $('.images-preloader').fadeOut();
    });
    /* End Images Loader*/

    /* Masonry Section */
    $(window).on('load', function() {
        var $grid = $('.grid').masonry({
            itemSelector: '.grid-item',
            percentPosition: true,
            columnWidth: '.grid-sizer',
        });
        // layout Masonry after each image loads
        // $grid.imagesLoaded().progress(function() {
        //     $grid.masonry();
        // });
    });
    /* End Masonry Section */

    /*Header Scroll*/
    /*Fixed Navbar When Scroll*/
    var navbarFix = $("#js-navbar-fixed");
    var headerOffset = navbarFix.offset().top + 100;
    $(window).on('scroll',function () {
        if ($(window).scrollTop() > headerOffset) {
            navbarFix.addClass('fixed animated slideInDown').removeClass("unfixed");
        } else {
            navbarFix.addClass('unfixed').removeClass("fixed animated slideInDown");
        }
    });
    /*End Header Scroll*/

    /*Fixed Navbar When Scroll*/
    var mbnavbarFix = $("#js-navbar-mb-fixed");
    var headerOffsetmb = mbnavbarFix.offset().top + 80;
    $(window).on('scroll',function () {
        if ($(window).scrollTop() > headerOffsetmb) {
            mbnavbarFix.addClass('fixed animated slideInDown').removeClass("unfixed");
        } else {
            mbnavbarFix.addClass('unfixed').removeClass("fixed animated slideInDown");
        }
    });
    /*End Header Scroll*/

    /*Mobile Menu*/
    /*Hamburger Button*/
    $('.hamburger').on("click", function () {
        $(this).toggleClass("is-active");
        $('.au-navbar-mobile').slideToggle(200, 'linear');
    });
    /*Navbar menu dropdown*/
    $('.au-navbar-mobile .au-navbar-menu .drop .drop-link').on('click', function (e) {
        $(this).siblings('.drop-menu').slideToggle(200, 'linear');
        $(this).toggleClass('clicked');
        e.stopPropagation();
    });
    /*End Mobile Menu*/

    /*Back To Top Button*/
    $(window).on('scroll',function () {
        if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $('#back-to-top').on( 'click', function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    /*End Back To Top Button*/

    /*Scoll Silder Revolution*/
    $(".scroll-slider1").on('click', function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#story-hp-1").offset().top
        }, 1000);
    });
    /*End Scoll Silder Revolution*/

    /*Datepicker hp-1*/
    $( "#date" ).datepicker({
        dateFormat: "MM - DD - yy",
        showOn: "both",
        buttonText : '<i class="zmdi zmdi-calendar-alt"></i>',
    });
    /*End Datepicker hp-1*/

    /* Video*/
    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 640,
            defaultH: 360
        }, options );

        $(settings.classBtn).on('click', function(e) {
            var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;

            var dataVideo = {
                'src': $(this).attr('data-bmdSrc'),
                'height': $(this).attr('data-bmdHeight') || settings.defaultH,
                'width': $(this).attr('data-bmdWidth') || settings.defaultW
            };

            if ( allowFullscreen ) dataVideo.allowfullscreen = "";

            // stampiamo i nostri dati nell'iframe
            $(self).find("iframe").attr(dataVideo);
        });

        // se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
        this.on('hidden.bs.modal', function(){
            $(this).find('iframe').html("").attr("src", "");
        });

        return this;
    };
    jQuery("#modal-video").bmdIframe();
    /*End Video*/

    /*Slider Revolution For Hp-1*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
    jQuery('#rev_slider_1').show().revolution({

        responsiveLevels: [1200, 992, 768, 576],
        autoHeight: 'on',
        sliderLayout: 'fullscreen',

        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        navigation: {

            arrows: {
                enable: false,

            },

            bullets: {
                enable: false
            }
        }
    });
    /*End Slider Revolution For Hp-1*/

    /*Slider Revolution For Hp-2*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
    jQuery('#rev_slider_2').show().revolution({

        responsiveLevels: [1200, 992, 768, 576],

        gridheight:[745, 745, 850, 950],

        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        navigation: {

            arrows: {
                enable: true,
                style: 'zeus',
                tmp: '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div></div>',
                hide_onleave: false,
                hide_onmobile: true,
                hide_under: 576,

            },

            bullets: {
                enable: true,
                style: 'uranus',
                tmp: '<span class="tp-bullet-inner"></span>',
                hide_onleave: false,
                h_align: "center",
                v_align: "bottom",
                h_offset: 0,
                v_offset: 20,
                space: 5
            }
        }
    });
    /*End Slider Revolution For Hp-2*/

    /*Slider Revolution For Hp-3*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
    jQuery('#rev_slider_3').show().revolution({

        responsiveLevels: [1200, 992, 768, 576],

        gridheight:[800, 800, 950, 1050],

        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        navigation: {

            arrows: {
                enable: false,

            },

            bullets: {
                enable: false,
            }
        }
    });
    /*End Slider Revolution For Hp-3*/

    /*Slider Revolution For Hp-4 */
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
    jQuery('#rev_slider_4').show().revolution({

        responsiveLevels: [1200, 992, 768, 576],
        autoHeight: 'on',
        sliderLayout: 'fullscreen',

        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        navigation: {

            arrows: {
                enable: true,
                style: 'zeus',
                tmp: '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div></div>',
                hide_onleave: false,
                hide_onmobile: true,
                hide_under: 576,

            },

            bullets: {
                enable: true,
                style: 'uranus',
                tmp: '<span class="tp-bullet-inner"></span>',
                hide_onleave: false,
                h_align: "center",
                v_align: "bottom",
                h_offset: 0,
                v_offset: 20,
                space: 5
            }
        }
    });
    /*End Slider Revolution For Hp-4*/

    /*Slider Revolution For Hp-6*/
    /* initialize the slider based on the Slider's ID attribute FROM THE WRAPPER above */
    jQuery('#rev_slider_6').show().revolution({

        responsiveLevels: [1200, 992, 768, 576],
        autoHeight: 'on',
        sliderLayout: 'fullscreen',

        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        navigation: {

            arrows: {
                enable: true,
                style: 'zeus',
                tmp: '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div></div>',
                hide_onleave: false,
                hide_onmobile: true,
                hide_under: 576,

            },

            bullets: {
                enable: false
            }
        }
    });
    /*End Slider Revolution For Hp-6*/

    /*Feature Section hp-1 + Events Section*/
    $('#feature-hp-1').owlCarousel({
        items:1,
        loop:false,
        margin: 30,
        nav:true,
        navText: [
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Feature Section hp-1 + Events Section*/

    /*Events Section hp-6*/
    $('#feature-hp-6').owlCarousel({
        items:1,
        loop:false,
        margin: 30,
        nav:true,
        navText: [
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Events Section hp-6*/

    /*Our Menu Section hp-1*/
    $('#menu-hp-1').owlCarousel({
        items:1,
        loop:false,
        margin: 30,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        thumbs: true,
        thumbImage: false,
        URLhashListener:true,
        autoplayHoverPause:true,
        startPosition: 'URLHash',
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Our Menu Blog Section hp-1*/

    /*Blog Section of Blog List Page*/
    $('#blog-list').owlCarousel({
        items:1,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Blog Section Blog List Page*/

    /*Events Section of Events Details Page*/
    $('#events-details').owlCarousel({
        items:1,
        loop:true,
        margin: 30,
        nav:true,
        navText: [
            "<i class='zmdi zmdi-chevron-left'></i>",
            "<i class='zmdi zmdi-chevron-right'></i>"],
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Events Section of Events Details Page*/

    /*Testimonials Section of About Page*/
    $('#about-testimonials').owlCarousel({
        items:2,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:2
            }
        }
    });
    /*End Testimonials Section of About Page*/

    /*Menu Salad Section of Menu Starter Page + Menu Steak Section of Menu Dinner Page + Menu Spaghetii Section of Menu Lunch Page*/
    $('#salad-section').owlCarousel({
        items:2,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:2
            }
        }
    });
    /*End Menu Salad Section of Menu Starter Page + Menu Steak Section of Menu Dinner Page + Menu Spaghetii Section of Menu Lunch Page*/

    /*Menu Curry Section of Menu Starter Page + Menu Soup Section of Menu Dinner Page*/
    $('#curry-section').owlCarousel({
        items:2,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:2
            }
        }
    });
    /*End Menu Curry Section of Menu Starter Page + Menu Soup Section of Menu Dinner Page*/

    /*Menu Potato Section of Menu Starter Page + Menu Fish Section of Menu Dinner Page + Menu Turkey Section of Menu Lunch Page*/
    $('#potato-section').owlCarousel({
        items:2,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:2
            }
        }
    });
    /*End Menu Potato Section of Menu Starter Page + Menu Fish Section of Menu Dinner Page + Menu Turkey Section of Menu Lunch Page*/

    /*Menu Pizza Section of Menu Dinner Page*/
    $('#pizza-section').owlCarousel({
        items:2,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:2
            }
        }
    });
    /*End Pizza Section of Menu Dinner Page*/

    /*Featured Section hp-4*/
    $('#feature-hp-4').owlCarousel({
        items:1,
        loop:false,
        margin: 30,
        nav:true,
        slideSpeed: 300,
        panigationSpeed: 400,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            576:{
                items:1

            },
            992:{
                items:1
            }
        }
    });
    /*End Featured Section hp-4*/

    /* Countdown Timer Of Comming Soon Page*/
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        if (clock != null) {
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');
            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
    }

    var deadline = new Date(Date.parse(new Date()) + 22 * 24 * 60 * 60 * 1000);
    initializeClock('clockdiv', deadline);
    /*End Countdown Timer Of Comming Soon Page*/
})(jQuery);

