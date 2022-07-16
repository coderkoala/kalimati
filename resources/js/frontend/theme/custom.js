/*------------------------------------------------------------------
 * Theme Name: Oscorn - Consulting & Finance & Business HTML5 Template
 * Description: A Bootstrap Responsive Template
 * Version: 1.0
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2018.
 -------------------------------------------------------------------*/

const { default: Swal } = require("sweetalert2");


(function ($) {
    "use strict";

    var $main_window = $(window);

    /*====================================
      preloader js
      ======================================*/
    $main_window.on("load", function () {
        $("#preloader").fadeOut("slow");
    });

    /*====================================
          scroll to top js
      ======================================*/
    $main_window.on("scroll", function () {
        if ($(this).scrollTop() > 250) {
            $("#scrollToTop").addClass('active');
        } else {
            $("#scrollToTop").removeClass('active');
        }
    });
    $("#scrollToTop").on("click", function () {
        $("html, body").animate(
            {
                scrollTop: 0
            },
            "slow"
        );
        return false;
    });


    /*=======================================
    affix  menu js
    ======================================= */

    $main_window.on('scroll', function () {
        var scroll = $main_window.scrollTop();
        if (scroll >= 200) {
            $(".menubar").addClass("sticky-menu");
        } else {
            $(".menubar").removeClass("sticky-menu");
        }
    });
    $main_window.on('scroll', function () {
        var scroll = $main_window.scrollTop();
        if (scroll >= 200) {
            $(".theme-mobile-menu").addClass("sticky-menu");
        } else {
            $(".theme-mobile-menu").removeClass("sticky-menu");
        }
    });


    /*====================================
      mobile menu js
      ======================================*/

    $(".menu-wrap")
        .clone()
        .appendTo(".mobile-menu");

    var $mob_menu = $("#mobile-m");
    $(".close-menu").on("click", function () {
        $mob_menu.toggleClass("menu-show");
    });


    $(".menu-toggle").on("click", function () {
        $mob_menu.toggleClass("menu-show");
    });
    $(".mobile-menu .has-sub .menu-link, .mobile-menu .sub-menu-link").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .toggleClass("current");
        $(this)
            .next()
            .slideToggle();

        try {
            if ($(this).attr('href')) {
                window.location.href = $(this).attr('href');
            }
        } catch (e) { }
    });


    /*====================================
          OWL CAROUSEL JS
    ======================================*/

    $(function () {
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 1,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            loop: true,
        });
    });

    /*====================================
          TEAM REDEINED TAB PANEL
    ======================================*/
    if ($(".service-01").length > 0) {
        $(".service-wrap").on("click", function () {
            var tab_id = $(this).attr("data-tab");

            $(".service-wrap").removeClass("current");
            $(".panel-content").removeClass("current");

            $(this).addClass("current");
            $("#" + tab_id).addClass("current");
        });
    }

    /*====================================
          CASE STUDY TAB PANEL
      ======================================*/
    if ($(".case-study").length > 0) {
        $(".case-tab").on("click", function () {
            var tab_id = $(this).attr("data-tab");

            $(".case-tab").removeClass("active");
            $(".case-content").removeClass("active");

            $(this).addClass("active");
            $("#" + tab_id).addClass("active");
        });
    }

    if ($(".count").length > 0) {
        $(".count").counterUp({
            delay: 10,
            time: 2000
        });
    }

    if ($(".progres").length > 0) {
        $("h5.prog-count").counterUp({
            delay: 15,
            time: 2000
        });
    }
})(jQuery);

((function ($) {
    $(function () {
        var btn = $('#findfees');

        btn.on('click', function (e) {
            e.preventDefault();
            $(".alert-danger").addClass('notice-error-404');
            $("#findfees").fadeOut(500);

            jQuery('#preloader').show();
            jQuery.ajax({
                method: "POST",
                url: '/dues',
                data: {
                    'id': jQuery('#id').val(),
                    '_token': jQuery('#csrf').val(),
                },
                dataType: 'json',
                success: function (response) {
                    if ('error' === response.icon) {
                        Swal.fire({
                            icon: response.icon,
                            title: response.header,
                            html: response.error,
                        });
                        $('.ajax-hide').hide();
                        $('.alert-danger').removeClass('notice-error-404');
                        $('.alert-danger').fadeIn(2000);
                    } else {
                        var pricingData;
                        if (undefined !== response.message) {
                            pricingData = response.message;
                            Object.keys(pricingData).forEach(function (index) {
                                $('#' + index).html(pricingData[index])
                            });
                            $('#tAmt').val(pricingData.totalamt).trigger('change');
                            $('#amt').val(pricingData.totalamt).trigger('change');
                            $('.ajax-hide').show();
                        }
                        $(".project-detail").slideDown("slow");
                        $('.alert-danger').addClass('notice-error-404');
                        $('html, body').animate({ scrollTop: $('.project-detail').offset().top - 150 }, 'slow');

                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error!',
                        icon: 'error',
                        text: 'Error occured. Please try again later.',
                    });
                }
            });
            $('#preloader').hide();
            $("#findfees").fadeIn(200);
        })
    });
})(jQuery.noConflict()));

jQuery(function ($) {
    $("div[id^='notice']").each(function (i, el) {
        var currentModal = $(el);
        currentModal.find('.btn-next').on('click', function () {
            currentModal.modal('hide');
        });

        currentModal.on('hidden.bs.modal', function (e) {
            $(this).closest("div[id^='notice']").nextAll("div[id^='notice']").first().modal('show');
        });
    });

    if ($("div[id^='notice']").length > 0) {
        $("div[id^='notice']").first().modal();
    }

    $('.btn-close-modal').on('click', function () {
        $('div.modal,div.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });
});

jQuery(function ($) {
    var i18n = $('html').attr('lang'),
    i18nurl = 'https://kmdb.info.np/vendor/dt/i18n_en.json';
    if ( 'ne' === i18n ) {
        i18nurl = 'https://kmdb.info.np/vendor/dt/i18n_np.json';
    }

    try {
        $('.dt').dataTable( {
            scrollY:        400,
            responsive: true,
            deferRender:    true,
            scroller:       true,
            pageLength: 10,
            language: {
                url : i18nurl,
            },
        });

        $('.dt-large').dataTable( {
            scrollY:        600,
            responsive:     true,
            deferRender:    true,
            scroller:       true,
            pageLength: 25,
            language: {
                url : i18nurl,
            },
        });
    } catch(e){}
});

((function ($) {
    $(function () {
        var btn = $('#commodity_selector');

        btn.on('change', function (e) {
            e.preventDefault();
            $(".pro-info").fadeOut(500);

            $('#preloader').show();
            $.ajax({
                method: "POST",
                url: $(btn).closest('form').attr('action') + '/' + $(btn).val(),
                data: {
                    'locale': $(btn).data('locale'),
                    '_token': $('#csrf').val(),
                    'from': $('#from').val(),
                    'to': $('#to').val(),
                },
                dataType: 'json',
                success: function (xhr) {
                    var labels = xhr.prices.date;

                    var data = {
                        labels: labels,
                        datasets: [
                            // {
                            //     label: xhr.commodity
                            //         + ' '
                            //         + $('#commodity_selector').data('minimum'),
                            //     backgroundColor: 'pink',
                            //     borderColor: 'pink',
                            //     data: xhr.prices.min,
                            // },
                            // {
                            //     label: xhr.commodity
                            //         + ' '
                            //         + $('#commodity_selector').data('maximum'),
                            //     backgroundColor: 'green',
                            //     borderColor: 'green',
                            //     data: xhr.prices.max,
                            // },
                            {
                                label: xhr.commodity
                                    + ' '
                                    + $('#commodity_selector').data('average'),
                                backgroundColor: 'green',
                                borderColor: 'green',
                                data: xhr.prices.avg,
                            },
                        ]
                    };
                    var config = {
                        type: 'line',
                        data: data,
                        options: {
                            elements: {
                                line: {
                                    tension: 0.4 // disables bezier curves
                                }
                            },
                        }
                    };
                    document.getElementById('pro-info').innerHTML = '<canvas id="priceChart"></canvas>';
                    new Chart(
                        document.getElementById('priceChart'),
                        config
                    );
                    $('#preloader').hide();
                    $(".pro-info").fadeIn(200);
                },
                error: function (xhr) {
                    Swal.fire({
                        title: $('#commodity_selector').data('title'),
                        icon: 'error',
                        text: $('#commodity_selector').data('message'),
                    });
                    $('#preloader').hide();
                    $(".pro-info").fadeIn(200);
                }
            });
        });
    });
})(jQuery.noConflict()));

((function ($) {
    $(function () {
        var btn = $('#arrival_selector');

        btn.on('change', function (e) {
            e.preventDefault();
            $(".pro-info").fadeOut(500);

            $('#preloader').show();
            $.ajax({
                method: "POST",
                url: $(btn).closest('form').attr('action') + '/' + $(btn).val(),
                data: {
                    'locale': $(btn).data('locale'),
                    '_token': $('#csrf').val(),
                    'from': $('#from').val(),
                    'to': $('#to').val(),
                },
                dataType: 'json',
                success: function (xhr) {
                    var labels = xhr.data.date;

                    var data = {
                        labels: labels,
                        datasets: [
                            {
                                label: xhr.commodity
                                    + ' '
                                    + $('#arrival_selector').data('arrival'),
                                backgroundColor: 'green',
                                borderColor: 'green',
                                data: xhr.data.qty,
                            },
                        ]
                    };
                    var config = {
                        type: 'line',
                        data: data,
                        options: {
                            elements: {
                                line: {
                                    tension: 0.4 // disables bezier curves
                                }
                            },
                        }
                    };
                    document.getElementById('pro-info').innerHTML = '<canvas id="priceChart"></canvas>';
                    new Chart(
                        document.getElementById('priceChart'),
                        config
                    );
                    $('#preloader').hide();
                    $(".pro-info").fadeIn(200);
                },
                error: function (xhr) {
                    Swal.fire({
                        title: $('#commodity_selector').data('title'),
                        icon: 'error',
                        text: $('#commodity_selector').data('message'),
                    });
                    $('#preloader').hide();
                    $(".pro-info").fadeIn(200);
                }
            });
        });
    });
})(jQuery.noConflict()));
