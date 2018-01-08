/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {

    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.

    // Note that pages with hyphens need to be changed to underscores here (ie: /about-us = about_us)
    var Sage = {
        // All pages
        'common': {
            init: function () {
                window.viewportUnitsBuggyfill.init();
                $(".content-block-gallery").slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });

                var resizeSlickTrack = function() {
                    var sliderHeight = $('.content-block .slick-track').height();
                    var textWrappingHeight = $('.content-block .slick-track .text-wrapping').height() + 120;
                    var finalHeight = (sliderHeight - textWrappingHeight)/2;

                    if ($(window).width() > 768) {
                        $('.content-block .slick-track .text-wrapping').css({'top' : finalHeight});
                    } else {
                        $('.content-block .slick-track .text-wrapping').css({'top' : 0});
                    }
                };
                var resizeArticleGrid = function() {
                    var blockHeight = $('.article-block.image-block').height() - 80;

                    $('.article-block.body-block').each(function() {
                        $(this).height(blockHeight);
                    });
                };
                var resizers = function(){
                    resizeSlickTrack();
                    resizeArticleGrid();
                };

                $(window).load(resizers);
                $(window).resize(resizers);

                $("li.menu-item-has-children").each(function() {
                   $(this).append('<span class="menu-open closed"><i class="fa fa-angle-down" aria-hidden="true"></i></span><span class="menu-close" style="display: none;"><i class="fa fa-angle-up" aria-hidden="true"></i></span>');
                });

                $("li.menu-item-has-children span").click(function() {
                    var subMenu = $(this).parent().children(".sub-menu-wrap");
                    $(subMenu).slideToggle();

                    if($(this).hasClass('opened')) {
                        $(this).hide();
                        $(this).siblings('.menu-open').show();
                        $(this).siblings('.menu-open').addClass('closed');
                        $(this).removeClass('opened');
                    } else if($(this).hasClass('closed')) {
                        $(this).hide();
                        $(this).siblings('.menu-close').show();
                        $(this).siblings('.menu-close').addClass('opened');
                        $(this).removeClass('closed');
                    }
                });

                //Custom mobile tabs - Tabbed Content and Tabbed Gallery
                /*$(".content-block").each(function(){
                    var context = $(this),
                        tabItems = $(this).find(".user-tab");

                    $(this).find(".mobile-prev-tab").on("click", ".tab-link", function(e){
                        e.preventDefault();

                        var current = context.find(".active.tab-link").parent();
                        var target = current.prev(".user-tab").length ? current.prev(".user-tab") : tabItems.last(".user-tab");
                        target.find(".tab-link").tab("show").trigger("tabbed-mobile-prev", [tabItems.index(target)]);
                    });
                    $(this).find(".mobile-next-tab").on("click", ".tab-link", function(e){
                        e.preventDefault();

                        var current = context.find(".active.tab-link").parent();
                        var target = current.next(".user-tab").length ? current.next(".user-tab") : tabItems.first(".user-tab");
                        target.find(".tab-link").tab("show").trigger("tabbed-mobile-next", [tabItems.index(target)]);
                    });
                });*/

                //Tabbed Gallery Component
                $(".content-block-tabbed_gallery").each(function(){
                    var sliderElement = $(this).find(".background-slider");
                    sliderElement.slick({
                        dots: false,
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: true
                    });
                    $(this).find(".user-tab .tab-link").click(function(e){
                        e.preventDefault();
                        sliderElement.slick('slickGoTo', $(this).parent().index(".user-tab"));
                    })/*.on("tabbed-mobile-prev tabbed-mobile-next", function(e, index){
                        sliderElement.slick('slickGoTo', index);
                    })*/;
                });
                $("input[name='zip'], #search-zip").inputmask({
                    mask: ["99999", "a9a 9a9"],
                    placeholder: ""
                });
                /*$("#newsletter-signup").submit(function(e){
                    e.preventDefault();
                    var html5Email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
                        email = $("#newsletter-email").val();

                    if(html5Email.test(email)){
                        $.post(Marc.ajax_url, {
                            action: "newsletter_signup",
                            nonce: Marc.nonce,
                            email: email
                        }, function(response){
                            //TODO: Output this message on the page

                        });
                    }
                    else{
                        var msg = email ? 'Please enter a valid email' : 'Email cannot be blank';
                        //TODO: Output this message on the page
                        console.log(msg);
                    }
                });*/

                $(window).load(function() {
                    var sliderHeight = $('.content-block .slick-track').height();
                    var textWrappingHeight = $('.content-block .slick-track .text-wrapping').height() + 120;
                    var finalHeight = (sliderHeight - textWrappingHeight)/2;

                    if ($(window).width() > 768) {
                        $('.content-block .slick-track .text-wrapping').css({'top' : finalHeight});
                    } else {
                        $('.content-block .slick-track .text-wrapping').css({'top' : 0});
                    }
                });

                $(window).resize(function() {
                    var sliderHeight = $('.content-block .slick-track').height();
                    var textWrappingHeight = $('.content-block .slick-track .text-wrapping').height() + 120;
                    var finalHeight = (sliderHeight - textWrappingHeight)/2;

                    if ($(window).width() > 768) {
                        $('.content-block .slick-track .text-wrapping').css({'top' : finalHeight});
                    } else {
                        $('.content-block .slick-track .text-wrapping').css({'top' : 0});
                    }
                });

                $(".donate-inner input[name='amount']").change(function(){
                    var target = $("#other-amount-text-group");
                    if($(this).is("#amount-other")){
                        target.slideDown();
                        $("#other-amount-text-input").focus();
                    }
                    else{
                        target.slideUp();
                    }
                });
                $("#other-amount-text-input").bind("input", function(){
                    $("#amount-other")[0].value = $(this).val();
                });
                $("#mobile-link-to-top").on("click", function(e){
                    e.preventDefault();
                    $("body, html").animate({scrollTop: 0}, 'slow');
                });
            },
            finalize: function () {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        // Home page
        'home': {
            init: function () {
                // JavaScript to be fired on the home page

                //Homepage Slider
                $(".homepage-gallery-wrapper").slick({
                    arrows: false,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    infinite: true,
                    speed: 300
                    //adaptiveHeight: true
                });

            },
            finalize: function () {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // Financials
        'financials': {
            init: function () {

                // JavaScript to be fired on the financials page
                var ctx = document.getElementById("chart1").getContext('2d');
                var chart1 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Fundraising Expenses", "Management & General Expenses", "Programming Expenses"],
                        datasets: [{
                            label: 'ALLOCATION OF EXPENSES',
                            data: [9, 3, 88],
                            backgroundColor: [
                                'rgba(45, 44, 44, 1)',
                                'rgba(179, 179, 179, 1)',
                                'rgba(236, 23, 72, 1)'
                            ],
                            borderColor: [
                                'rgba(45, 44, 44, 1)',
                                'rgba(179, 179, 179, 1)',
                                'rgba(236, 23, 72, 1)'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "ALLOCATION OF EXPENSES",
                            fontSize: 22,
                            fontStyle: "Bold",
                            fontFamily: "Roboto, Helvetica Neue, Arial, sans-serif",
                            fontColor: "#202021",
                            position: "bottom"
                        },
                        tooltips: {
                          mode: 'point'
                        },
                        legend: {
                          display: false
                        },
                        responsive: true,
                        scales: {
                            xAxes: [{
                                display: this.scalesdisplay,
                                ticks: {
                                    beginAtZero:this.beginzero
                                }
                            }],
                            yAxes: [{
                                display: this.scalesdisplay,
                                ticks: {
                                    beginAtZero:this.beginzero
                                }
                            }]
                        }
                    }
                });


                var ctx2 = document.getElementById("chart2").getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'horizontalBar',
                    data: {
                        labels: ["INDUSTRY STANDARD", "GIRLS INC."],
                        datasets: [{
                            label: 'CASH RESERVE',
                            data: [105, 277],
                            backgroundColor: [
                                'rgba(45, 44, 44, 1)',
                                'rgba(236, 23, 72, 1)'
                            ],
                            borderColor: [
                                'rgba(45, 44, 44, 1)',
                                'rgba(236, 23, 72, 1)'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "CASH RESERVE",
                            fontSize: 22,
                            fontStyle: "Bold",
                            fontFamily: "Roboto, Helvetica Neue, Arial, sans-serif",
                            fontColor: "#202021",
                            position: "top"
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            mode: 'nearest'
                        },
                        curvature: 0.5,
                        maxBarThickness: 25,
                        responsive: true,
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                    lineWidth: 5,
                                    color: 'rgba(45, 44, 44, 1)'
                                },
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    display: true

                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                    lineWidth: 5,
                                    color: 'rgba(45, 44, 44, 1)'
                                },
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    display: true,
                                    fontColor: '#232323',
                                    fontSize: 14,
                                    fontStyle: "Bold",
                                    fontFamily: "Roboto, Helvetica Neue, Arial, sans-serif"
                                }
                            }]
                        }
                    }
                });

            },
            finalize: function () {
                // JavaScript to be fired on the financials page, after the init JS
            }
        },
        // Leadership page
        'leadership': {
            init: function () {

                $(window).load(function() {
                    var grid = $('.leadership-archive').isotope({
                        itemSelector: '.leadership',
                        layoutMode: 'fitRows',
                        percentPosition: true
                    });

                    grid.isotope({ filter: ".positions-board-of-directors" });


                    $(".leadership").removeClass("loading");

                    $('.filter-option').on( 'click', 'a', function(e) {
                        e.preventDefault();
                        var filter = $(this).attr("data-filter");
                        grid.isotope({ filter: filter });

                        $('.filter-option a').removeClass('active-filter');
                        $(this).addClass('active-filter');
                    });

                });
            }
        },
        //Our Investors
        'programs' : {
            init: function() {
                $('.see-more-link a').on('click', function(e) {
                    e.preventDefault();
                    var dataID = $(this).attr('data-id');
                    var target = $('#' + dataID);

                    target.toggle();
                    //if (target.width() < 768) {
                    var height = target.is(":visible") ? target.outerHeight() : 'auto';
                    target.parent().height(height);
                    //}
                    $(this).toggleText('See Less', 'See More');
                });
            }
        },
        'advocacy': {
            init: function() {
                $('.see-more-link a').on('click', function(e) {
                    e.preventDefault();
                    var dataID = $(this).attr('data-id');
                    var target = $('#' + dataID);

                    target.toggle();
                    //if (target.width() < 768) {
                        var height = target.is(":visible") ? target.outerHeight() : 'auto';
                        target.parent().height(height);
                    //}
                    $(this).toggleText('See Less', 'See More');
                });

                /*$(window).load(function() {

                    var titleHeight = 70;

                    rebuildTitleSizes(titleHeight);

                    $(window).resize(function () {
                       rebuildTitleSizes(titleHeight);
                    })

                    function rebuildTitleSizes(titleHeight) {
                        jQuery('.advocacy-title').each(function() {
                            var currentHeight = jQuery(this).height();
                            if (currentHeight >= titleHeight) {
                                titleHeight == currentHeight;
                            }
                        });

                        jQuery('.advocacy-title').each(function() {
                            jQuery(this).height(titleHeight);
                        });
                    }
                });*/
            }
        },
        //Map
        'find_girls_inc': {
            RADIUS: 100,
            map: null,
            info: null,
            markers: {},
            searches: {},
            current: {
                zip: false,
                center: null,
                markers: []
            },
            tpl: {
                results: null,
                noresults: null,
                info: null,
                init: function(){
                    this.results = $("#template-results").children().clone();
                    this.noresults = $("#template-noresults").children().clone();
                    this.info = $("#template-info").clone();
                },
                render: function(tpl, data){
                    switch(tpl){
                        case "results" :
                            var result = this.results.clone();

                            result.attr("data-attr-ID", data.ID);
                            result.find(".primary-info").attr("data-target", "#additional-info-"+data.ID);

                            result.find(".location-name").text(data.name);
                            result.find(".location-address").html(data.address.human.nl2br());
                            result.find(".additional-info").attr("id", "additional-info-"+data.ID);

                            var directorField = result.find(".director-name"),
                                directorTitle = result.find(".director-title"),
                                phoneField = result.find(".location-phone"),
                                faxField = result.find(".location-fax"),
                                emailField = result.find(".location-email"),
                                websiteField = result.find(".location-website");


                            data.director ? directorField.text(data.director) : directorField.remove();
                            data.leadertitle ? directorTitle.text(data.leadertitle) : directorTitle.remove();
                            data.phone ? phoneField.append(data.phone) : phoneField.remove();
                            data.fax ? faxField.append(data.fax) : faxField.remove();
                            data.email ? emailField.attr("href", "mailto:"+data.email) : emailField.remove();
                            data.website ? websiteField.attr("href", data.website) : websiteField.remove();
                            return result;
                        break;
                        case "noresults" :
                            return this.noresults.clone();
                        break;
                        case "info" :
                            var box = this.info.clone(),
                                phoneInfo = box.find(".info-phone");

                            box.find(".info-name").text(data.name);
                            box.find(".info-address").html(data.address.human.nl2br());
                            box.find(".info-distance").text("Approx. Distance: ~"+data.distance+" miles");

                            data.phone ? phoneInfo.append(data.phone) : phoneInfo.remove();

                            return box.html();
                        break;
                        default:
                            return undefined;
                    }
                }
            },
            init: function() {

                var self = this,
                    search = $("#search-zip");

                search.bind("input", function(){
                    if($(this).inputmask("isComplete") && $(this).val() !== self.current.zip){
                        $("#form-clear").hide();
                        $("#form-submit").show();
                    }
                    else{
                        $("#form-clear").show();
                        $("#form-submit").hide();
                    }
                }).trigger("input");

                
                $("#search-map").submit(function(e){
                    e.preventDefault();

                    var zipField = $("#search-zip");
                    var zip = zipField.val();


                    if(zip !== self.current.zip){
                        if(zipField.inputmask("isComplete")){

                            self.info.close(); //Close any open windows
                            zipField.blur(); //Close the mobile keyboard
                            $("html,body").stop().animate({ scrollTop: 0 }, 'slow');

                            if(typeof self.searches[zip] !== "undefined"){
                                //Loading markers from cache
                                self.current = self.searches[zip];
                                self.outputResults.call(self, self.searches[zip]);
                            }
                            else{
                                //Requesting data
                                self.requestResults(zip);
                            }
                        }
                        else{
                            //TODO: Output a meaningful error message
                            console.log("Please add a valid zip code");
                        }
                    }
                });


                var zipField = $("input[name=init-zip]");
                var zip = zipField.val();
                if(typeof zip !== 'undefined') {
                    zip = zip.split(',');
                    var result = {
                        center: null,
                        markers: []
                    };
                    for (var i = 0; i < Geo.markers.length; i++) {
                        if (Geo.markers[i].ID === zip[2]) {
                            result.markers[0] = {
                                data: Geo.markers[i]
                            }
                        }
                    }

                    result.center = new google.maps.LatLng(zip[0], zip[1]);

                    self.outputResults.call(self, result, true, 15)
                }

            },
            loadMap: function(){
                var self = this;
                var mapContainer = jQuery("#girlsinc-map");
                var center = new google.maps.LatLng(Geo.center[0], Geo.center[1]);

                google.maps.Marker.prototype.getDistance = function(latlng){
                    return self.getDistance(latlng, this.getPosition());
                };

                this.tpl.init();

                var initZoom = 5;
                if(Geo.zip){
                    initZoom = 8;
                }
                else if(Geo.state){
                    initZoom = 6;
                }

                this.map = new google.maps.Map(mapContainer[0], {
                    zoom: initZoom,
                    center: center,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    }
                });
                this.info = new google.maps.InfoWindow();

                this.current.zip = Geo.zip;
                this.current.center = center;
                this.markers = this.loadMarkers(Geo.markers);

                if(Geo.zip){
                    this.current.markers = this.getClosestMarkers(center, self.RADIUS);
                    this.searches[Geo.zip] = this.current;
                }
                else if(Geo.state){
                    this.current.markers = this.getMarkersInState(Geo.state);
                }

                if(Geo.zip || Geo.state){
                    this.outputResults(this.current, false);
                }
                else{

                }
            },
            loadMarkers: function(data){
                var self = this,
                    markers = {};

                for(var i=0;i<data.length;i++){

                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(data[i].address.data.lat),
                            lng: parseFloat(data[i].address.data.lng)
                        },
                        map: self.map,
                        animation: google.maps.Animation.DROP,
                        infoContent: function(){
                            this.data.distance = this.getDistance(self.current.center);
                            return self.tpl.render("info", this.data)
                        },
                        data: data[i]
                    });

                    marker.addListener('click', function(){
                        self.info.close();
                        self.info.setContent(this.infoContent());
                        self.info.open(self.map, this);
                        self.map.panTo(this.getPosition());

                        var scrollPanel = $("#map-search-wrapper"),
                            panelMarker = $(".location.row[data-attr-ID=\""+this.data.ID+"\"]");

                        if(panelMarker.length){
                            $("#additional-info-"+this.data.ID).collapse('show');
                            scrollPanel.stop().animate({
                                scrollTop: panelMarker.position().top
                            }, {
                                duration: 500,
                                easing: 'linear'
                            });
                        }
                    });

                    markers[data[i].ID] = marker;
                }
                return markers;
            },
            getMarkersInState: function(state){
                var countries = ["United States", "Canada"],
                    dataKey = "state";
                if(countries.indexOf(state) !== -1){
                    dataKey = "country";
                }

                var markers = this.markers;
                return Object.keys(markers).map(function(key) {
                    return markers[key];
                }).filter(function(marker){
                    return marker.data.address.data[dataKey].toLowerCase() === state.toLowerCase();
                });
            },
            getDistance: function(pt1, pt2){
                var meters = google.maps.geometry.spherical.computeDistanceBetween(pt1, pt2);
                var miles = meters / 1609.344;
                return miles.toFixed(2) / 1;
            },
            getClosestMarkers: function(latlng, distance){
                var markers = this.markers;
                return Object.keys(markers).map(function(key) {
                    return markers[key];
                }).filter(function(marker){
                    return marker.getDistance(latlng) <= distance;
                }).sort(function(a, b){
                    if(a.getDistance(latlng) < b.getDistance(latlng)) return -1;
                    if(a.getDistance(latlng) > b.getDistance(latlng)) return 1;
                    return 0;
                });
            },
            requestResults: function(zip){
                var self = this;
                $.post(Marc.ajax_url, {
                    action: "search_zip",
                    nonce: Marc.nonce,
                    zip: zip
                }, function(response){
                    var center = new google.maps.LatLng(response.geometry[0], response.geometry[1]);
                    var results = {
                        zip: zip,
                        center: center,
                        markers: self.getClosestMarkers.call(self, center, self.RADIUS)
                    };
                    self.searches[zip] = results;
                    self.current = results;
                    self.outputResults.call(self, results);
                }, 'json');
            },
            outputResults: function(results, panZoom, zoomPower){
                $(".results-label").removeClass("hidden-xs-up");

                if(typeof panZoom === 'undefined'){
                    panZoom = true;
                }

                if(typeof zoomPower === 'undefined'){
                    zoomPower = 8;
                }
                var container = $("#search-results");
                container.empty();

                if(results.markers.length){

                    for(var i=0;i<results.markers.length;i++){
                        container.append(this.tpl.render("results", results.markers[i].data));
                    }
                }
                else{
                    container.append(this.tpl.render("noresults"));
                }

                if(panZoom){

                    this.map.setZoom(zoomPower);
                    this.map.panTo(results.center);
                }

                $("#form-clear").show();
                $("#form-submit").hide();
            },
            finalize: function(){
                var self = this;

                $(".map-ui").remove();
                $("#search-results").on("mouseenter", ".location.row", function(e){
                    var markerId = $(this).attr("data-attr-ID");
                    var marker = self.markers[markerId];

                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(function(){
                        marker.setAnimation(null);
                    }, 750);
                });
            }
        },
        'blog': {
            init: function(){
                //AJAX Pagination
                var self = this;
                $("#other-news").on("click", ".pagination a", {bodyFragment: "#other-news-inner", scrollTo: "#other-news"}, this.runAJAX);
                $("#press-releases").on("click", ".pagination a", {bodyFragment: "#press-releases-inner", scrollTo: "#press-releases"}, this.runAJAX)
            },
            runAJAX: function(e){
                e.preventDefault();
                var target = e.data.bodyFragment;

                $(target).addClass("loading");
                $(target).load( $(this).attr("href") + " " + e.data.bodyFragment + " .news-inner-content", function(){
                    $("body, html").animate({ scrollTop: $(e.data.scrollTo)[0].offsetTop+"px" });
                    $(target).removeClass("loading");
                });
            }
        },
        'contact_us': {
            init: function(){
                $("body").on("wpcf7mailsent", function(){
                    window.location.href = '/contact-us/thank-you';
                });
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);
    $("#girlsinc-map").bind("mapInit", function(){
        UTIL.fire('find_girls_inc', 'loadMap');
    });

})(jQuery); // Fully reference jQuery after this point.


function mapOnReady(){
    jQuery("#girlsinc-map").trigger("mapInit");

}

jQuery.fn.extend({
    toggleText: function (a, b){
        var that = this;
        if (that.text() != a && that.text() != b){
            that.text(a);
        }
        else
        if (that.text() == a){
            that.text(b);
        }
        else
        if (that.text() == b){
            that.text(a);
        }
        return this;
    }
});

//Global
String.prototype.nl2br = function()
{
    return this.replace(/\n/g, "<br>");
};
