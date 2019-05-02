/**
 * Created by ckodia on 02/05/2019.
 */

(function ($) {
    // USE STRICT
    "use strict";

    try {
        //bar chart
        var ctx = document.getElementById("bilan");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'bar',
                defaultFontFamily: 'Poppins',
                data: {
                    labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre","Octobre","Novembre","Decembre"],
                    datasets: [
                        {
                            label: "Entrées",
                            data: [5, 4, 5, 11, 19, 11, 4,2,1,3,1,1,0],
                            borderColor: "rgba(0, 123, 255, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 123, 255, 0.5)",
                            fontFamily: "Poppins"
                        },
                        {
                            label: "Sorties",
                            data: [0, 0, 0, 2, 1, 2, 0,1,1,2,0,1,0],
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "#EF261C",
                            fontFamily: "Poppins"
                        }
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontFamily: "Poppins"

                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "Poppins"
                            }
                        }]
                    }
                }
            });
        }


    } catch (error) {
        console.log(error);
    }


    try {

        //pie chart
        var ctx = document.getElementById("effectif_globaux");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        // data: [9, 2, 80, 27,23],
                        data: $json_eff_globaux}},
                        backgroundColor: [
                "#138AD5",
                "#E3370D",
                "#08A451",
                "#6E08A4",
                "#13B1EC"
            ],
                hoverBackgroundColor: [
                "#138AD5",
                "#E3370D",
                "#08A451",
                "#6E08A4",
                "#13B1EC"
            ]

        }],
            labels: [
                "Expatriés PHB",
                "Expatriés DIR. CI",
                "Locaux EGC CI",
                "SPIE Fondations",
                "Sous - Traitant"
            ]
        },
            options: {
                legend: {
                    position: 'top',
                        labels: {
                        fontFamily: 'Poppins'
                    }

                },
                responsive: true
            }
        });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("effectif_locaux");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [9, 71],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D"
                        ]

                    }],
                    labels: [
                        "DIRECTION CI",
                        "PHB",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("repartition_h_f");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [57, 23],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D"
                        ]

                    }],
                    labels: [
                        "HOMME",
                        "FEMME",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("tranche_age");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [20, 48,25,8],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                        ]

                    }],
                    labels: [
                        "Moins de 30 ans",
                        "30 - 39 ans",
                        "40 - 49 ans",
                        "50 ans et +",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("anciennete_locaux");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [1, 7,51,12,9],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC"
                        ]

                    }],
                    labels: [
                        "> 3 mois",
                        "3 à 6 mois",
                        "7 à 10 mois",
                        "11 à 12 mois",
                        "> 12 mois",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("qualification_contractuel");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [8, 16,5,50,2],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC"
                        ]

                    }],
                    labels: [
                        "Cadres",
                        "Agents de Maitrise",
                        "Employés",
                        "Ouvriers",
                        "Stagiaires",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("nationalite");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [5, 69,1,1,1,3],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC",
                            "#EC9A13"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC",
                            "#EC9A13"
                        ]

                    }],
                    labels: [
                        "Burkina Faso",
                        "Côte d'Ivoire",
                        "France",
                        "Guinée",
                        "Niger",
                        "Togo",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }
    try {

        //pie chart
        var ctx = document.getElementById("service_personnel");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [12, 9,2,5,17,7,8,20],
                        backgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC",
                            "#EC9A13",
                            "#0B306A",
                            "#6A2B0B"
                        ],
                        hoverBackgroundColor: [
                            "#138AD5",
                            "#E3370D",
                            "#08A451",
                            "#6E08A4",
                            "#13B1EC",
                            "#EC9A13",
                            "#0B306A",
                            "#6A2B0B"
                        ]

                    }],
                    labels: [
                        "ADMINISTRATION PHB",
                        "DIRECTION CI",
                        "ETUDES METHODES ",
                        "HSE",
                        "MATERIEL",
                        "QUALITE",
                        "SERVICES GENERAUX",
                        "TRAVAUX",
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
    }

    try {

        // polar chart
        var ctx = document.getElementById("polarChart");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    datasets: [{
                        data: [15, 18, 9, 6, 19],
                        backgroundColor: [
                            "rgba(0, 123, 255,0.9)",
                            "rgba(0, 123, 255,0.8)",
                            "rgba(0, 123, 255,0.7)",
                            "rgba(0,0,0,0.2)",
                            "rgba(0, 123, 255,0.5)"
                        ]

                    }],
                    labels: [
                        "Green",
                        "Green",
                        "Green",
                        "Green"
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }

    } catch (error) {
        console.log(error);
    }

    try {

        // single bar chart
        var ctx = document.getElementById("singelBarChart");
        if (ctx) {
            ctx.height = 150;
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
                    datasets: [
                        {
                            label: "My First dataset",
                            data: [40, 55, 75, 81, 56, 55, 40],
                            borderColor: "rgba(0, 123, 255, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 123, 255, 0.5)"
                        }
                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontFamily: "Poppins"

                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "Poppins"
                            }
                        }]
                    }
                }
            });
        }

    } catch (error) {
        console.log(error);
    }

})(jQuery);



(function ($) {
    // USE STRICT
    "use strict";
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 900,
        outDuration: 900,
        linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([class^="chosen-single"])',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'page-loader',
        loadingInner: '<div class="page-loader__spin"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) {
            window.location.href = url;
        }
    });


})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    // Map
    try {

        var vmap = $('#vmap');
        if(vmap[0]) {
            vmap.vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        }

    } catch (error) {
        console.log(error);
    }

    // Europe Map
    try {

        var vmap1 = $('#vmap1');
        if(vmap1[0]) {
            vmap1.vectorMap( {
                map: 'europe_en',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                enableZoom: true,
                showTooltip: true
            });
        }

    } catch (error) {
        console.log(error);
    }

    // USA Map
    try {

        var vmap2 = $('#vmap2');

        if(vmap2[0]) {
            vmap2.vectorMap( {
                map: 'usa_en',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                enableZoom: true,
                showTooltip: true,
                selectedColor: null,
                hoverColor: null,
                colors: {
                    mo: '#001BFF',
                    fl: '#001BFF',
                    or: '#001BFF'
                },
                onRegionClick: function ( event, code, region ) {
                    event.preventDefault();
                }
            });
        }

    } catch (error) {
        console.log(error);
    }

    // Germany Map
    try {

        var vmap3 = $('#vmap3');
        if(vmap3[0]) {
            vmap3.vectorMap( {
                map: 'germany_en',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                onRegionClick: function ( element, code, region ) {
                    var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();

                    alert( message );
                }
            });
        }

    } catch (error) {
        console.log(error);
    }

    // France Map
    try {

        var vmap4 = $('#vmap4');
        if(vmap4[0]) {
            vmap4.vectorMap( {
                map: 'france_fr',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                enableZoom: true,
                showTooltip: true
            });
        }

    } catch (error) {
        console.log(error);
    }

    // Russia Map
    try {
        var vmap5 = $('#vmap5');
        if(vmap5[0]) {
            vmap5.vectorMap( {
                map: 'russia_en',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                hoverOpacity: 0.7,
                selectedColor: '#999999',
                enableZoom: true,
                showTooltip: true,
                scaleColors: [ '#C8EEFF', '#006491' ],
                normalizeFunction: 'polynomial'
            });
        }


    } catch (error) {
        console.log(error);
    }

    // Brazil Map
    try {

        var vmap6 = $('#vmap6');
        if(vmap6[0]) {
            vmap6.vectorMap( {
                map: 'brazil_br',
                color: '#007BFF',
                borderColor: '#fff',
                backgroundColor: '#fff',
                onRegionClick: function ( element, code, region ) {
                    var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
                    alert( message );
                }
            });
        }

    } catch (error) {
        console.log(error);
    }
})(jQuery);
(function ($) {
    // Use Strict
    "use strict";
    try {
        var progressbarSimple = $('.js-progressbar-simple');
        progressbarSimple.each(function () {
            var that = $(this);
            var executed = false;
            $(window).on('load', function () {

                that.waypoint(function () {
                    if (!executed) {
                        executed = true;
                        /*progress bar*/
                        that.progressbar({
                            update: function (current_percentage, $this) {
                                $this.find('.js-value').html(current_percentage + '%');
                            }
                        });
                    }
                }, {
                    offset: 'bottom-in-view'
                });

            });
        });
    } catch (err) {
        console.log(err);
    }
})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    // Scroll Bar
    try {
        var jscr1 = $('.js-scrollbar1');
        if(jscr1[0]) {
            const ps1 = new PerfectScrollbar('.js-scrollbar1');
        }

        var jscr2 = $('.js-scrollbar2');
        if (jscr2[0]) {
            const ps2 = new PerfectScrollbar('.js-scrollbar2');

        }

    } catch (error) {
        console.log(error);
    }

})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    // Select 2
    try {

        $(".js-select2").each(function () {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        });

    } catch (error) {
        console.log(error);
    }


})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    // Dropdown
    try {
        var menu = $('.js-item-menu');
        var sub_menu_is_showed = -1;

        for (var i = 0; i < menu.length; i++) {
            $(menu[i]).on('click', function (e) {
                e.preventDefault();
                $('.js-right-sidebar').removeClass("show-sidebar");
                if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
                    $(this).toggleClass('show-dropdown');
                    sub_menu_is_showed = -1;
                }
                else {
                    for (var i = 0; i < menu.length; i++) {
                        $(menu[i]).removeClass("show-dropdown");
                    }
                    $(this).toggleClass('show-dropdown');
                    sub_menu_is_showed = jQuery.inArray(this, menu);
                }
            });
        }
        $(".js-item-menu, .js-dropdown").click(function (event) {
            event.stopPropagation();
        });

        $("body,html").on("click", function () {
            for (var i = 0; i < menu.length; i++) {
                menu[i].classList.remove("show-dropdown");
            }
            sub_menu_is_showed = -1;
        });

    } catch (error) {
        console.log(error);
    }

    var wW = $(window).width();
    // Right Sidebar
    var right_sidebar = $('.js-right-sidebar');
    var sidebar_btn = $('.js-sidebar-btn');

    sidebar_btn.on('click', function (e) {
        e.preventDefault();
        for (var i = 0; i < menu.length; i++) {
            menu[i].classList.remove("show-dropdown");
        }
        sub_menu_is_showed = -1;
        right_sidebar.toggleClass("show-sidebar");
    });

    $(".js-right-sidebar, .js-sidebar-btn").click(function (event) {
        event.stopPropagation();
    });

    $("body,html").on("click", function () {
        right_sidebar.removeClass("show-sidebar");

    });


    // Sublist Sidebar
    try {
        var arrow = $('.js-arrow');
        arrow.each(function () {
            var that = $(this);
            that.on('click', function (e) {
                e.preventDefault();
                that.find(".arrow").toggleClass("up");
                that.toggleClass("open");
                that.parent().find('.js-sub-list').slideToggle("250");
            });
        });

    } catch (error) {
        console.log(error);
    }


    try {
        // Hamburger Menu
        $('.hamburger').on('click', function () {
            $(this).toggleClass('is-active');
            $('.navbar-mobile').slideToggle('500');
        });
        $('.navbar-mobile__list li.has-dropdown > a').on('click', function () {
            var dropdown = $(this).siblings('ul.navbar-mobile__dropdown');
            $(this).toggleClass('active');
            $(dropdown).slideToggle('500');
            return false;
        });
    } catch (error) {
        console.log(error);
    }
})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    // Load more
    try {
        var list_load = $('.js-list-load');
        if (list_load[0]) {
            list_load.each(function () {
                var that = $(this);
                that.find('.js-load-item').hide();
                var load_btn = that.find('.js-load-btn');
                load_btn.on('click', function (e) {
                    $(this).text("Loading...").delay(1500).queue(function (next) {
                        $(this).hide();
                        that.find(".js-load-item").fadeToggle("slow", 'swing');
                    });
                    e.preventDefault();
                });
            })

        }
    } catch (error) {
        console.log(error);
    }

})(jQuery);
(function ($) {
    // USE STRICT
    "use strict";

    try {

        $('[data-toggle="tooltip"]').tooltip();

    } catch (error) {
        console.log(error);
    }

    // Chatbox
    try {
        var inbox_wrap = $('.js-inbox');
        var message = $('.au-message__item');
        message.each(function(){
            var that = $(this);

            that.on('click', function(){
                $(this).parent().parent().parent().toggleClass('show-chat-box');
            });
        });


    } catch (error) {
        console.log(error);
    }

})(jQuery);