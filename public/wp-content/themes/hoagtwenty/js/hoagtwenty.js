/* off canvase functions */
$(function() {
    'use strict'
    $('[data-toggle="offcanvas"]').on('click', function() {
        $('.offcanvas-collapse').toggleClass('open');
        if ($(".utility-menu-collapse").hasClass('open')) {
            $(".utility-menu-collapse").toggleClass('open');
            /* $("#utilities-icon").toggleClass("position-fixed"); */
            $('#utilities-icon').toggleClass('open');

        } else {
            $('#body-disable').fadeToggle();
        }
    })
});
/* end off canvase functions */

$(function() {
    $('[data-toggle="popover"]').popover({
        html: true,
        content: function() {
            return $('#popover-menu').html();
        }
    });

    //menu animation
    $(".navbar-toggler").click(function() {
        $(".hamburger_button").toggleClass("close");
        $(".hamburger_button").toggleClass("position-fixed r-0 mr-4");
    });

    $(".offcanvas-collapse").click(function() {
        $(".hamburger_button").toggleClass("close");
        $(".hamburger_button").toggleClass("position-fixed r-0 mr-4");
        $(this).removeClass('open');
        $('#body-disable').fadeToggle();
    });


    $(".utility-menu-icon").click(function() {
        if ($('.offcanvas-collapse').hasClass('open')) {
            $('.offcanvas-collapse').toggleClass('open');
            $(".hamburger_button").toggleClass("close");
            $(".hamburger_button").toggleClass("position-fixed r-0  mr-4");

        } else {
            $('#body-disable').fadeToggle();
        }
        $(".utility-menu-collapse").toggleClass('open');

        $("#utilities-icon").toggleClass('open');

    });


    $('#body-disable').click(function() {
        $(this).fadeToggle();
        $(".utility-menu-collapse").removeClass('open');
        $("#utilities-icon").removeClass("position-fixed");
        $('.offcanvas-collapse').removeClass('open');
        $(".hamburger_button").removeClass("close");
        $("#utilities-icon").removeClass("open");
        $(".hamburger_button").removeClass("position-fixed");
        if ($(".utility-menu-collapse").hasClass('open')) {
            $("#utilities-icon").toggleClass("open");
        }
    });

    $('.show').click(function() {
        $(this).siblings('.hide').toggle();
        $(this).toggleClass('arrow-up-after');
        $(this).children('.hide').toggle();
    });
    $('.all-hours.hide').click(function() {
        $(this).hide();
        $('.show').toggleClass('rotate180');
    });

    /*carousel functionality*/
    var carousel = $('.card-carousel-wrapper');
    var carouselControl = '<button style="height:40px;width:40px;right: 0;left: 0;margin: auto; top: 35%;" class="font-reading d-none z-3 position-absolute carousel-controls mx-3 mx-xl-n3 px-0 rounded-circle border back">←</button>' +
        '<button style="height:40px;width:40px; right: 0;/* left: 0; */margin: auto; top: 35%;" class="font-reading  z-3 position-absolute carousel-controls mx-3 mx-xl-n3 px-0 rounded-circle next ml-auto border float-right">→</button>' +
        '<div class="indicators text-center mx-auto py-5 d-none d-md-block "></div>' +
        '</div>';

    $(carousel).each(function() {
        $(this).wrap("<div id='carousel' class='container-lg mx-auto px-0 position-relative'></div>");

        var carouselItems = $(this).children("div");
        var thecarousel = $(this);

        if (carouselItems.length > 3) {
            $(this).after(carouselControl);
            for (i = 0; i < carouselItems.length; i = i + 3) {
                $(thecarousel).siblings(".indicators").append('<span class="carousel-indicator d-none d-md-inline-flex"></span>');
            }
            $(thecarousel).siblings(".indicators").children(".carousel-indicator:first-child").addClass('active');
        }

        var width1 = $(this)[0].offsetWidth + 3;
        var next = $(this).siblings('.next');
        var back = $(this).siblings('.back');


        $(next).click(function() {
            if ($(thecarousel).siblings(".indicators").children(".carousel-indicator:first-child").hasClass('active')) {
                $(back).removeClass('d-none');
            }
            $(thecarousel).siblings(".indicators").children(".carousel-indicator.active").next().addClass('active').prev().removeClass('active');
            /* $(thecarousel).siblings(".indicators").children("carousel-indicator.active").prev().removeClass('active'); */
            if ($(thecarousel).siblings(".indicators").children(".carousel-indicator:last-child").hasClass('active')) {
                $(this).addClass('d-none');
            } else { $(this).removeClass('d-none'); }
            $(thecarousel).animate({ scrollLeft: '+=' + width1 }, 500);
        });

        $(back).click(function() {
            if ($(thecarousel).siblings(".indicators").children(".carousel-indicator:last-child").hasClass('active')) {
                $(next).removeClass('d-none');
            }
            $(thecarousel).siblings(".indicators").children(".carousel-indicator.active").prev().addClass('active').next().removeClass('active');

            if ($(thecarousel).siblings(".indicators").children("span:first-child").hasClass('active')) {
                $(this).addClass('d-none');
            } else { $(this).removeClass('d-none'); }
            $(thecarousel).animate({ scrollLeft: '-=' + width1 }, 500);
        });

        /*     setTimeout(function() {

                var maxHeight = 0;
                $(carouselItems).each(function() {
                    if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
                });
                $(carouselItems).height(maxHeight);
            }, 300); */
    });

    /* end carousel functionality*/
    /*     var scrollWidth = $('.scroll')[0].offsetWidth;
        var scrollSpeed = scrollWidth / 5;
        $('button#more').click(function() {
            $('.scroll').animate({ scrollLeft: '+=' + scrollWidth }, scrollSpeed);
        })
        $('button#back').click(function() {
            $('.scroll').animate({ scrollLeft: '-=' + scrollWidth }, scrollSpeed);
        }) */

    /*
          // Function which adds the 'animated' class to any '.animatable' in view
          var doAnimations = function() {
            
            // Calc current offset and get all animatables
            var offset = $(window).scrollTop() + $(window).height(),
                $animatables = $('.animatable');
            
            // Unbind scroll handler if we have no animatables
            if ($animatables.length == 0) {
              $(window).off('scroll', doAnimations);
            }
            
            // Check all animatables and animate them if necessary
                $animatables.each(function(i) {
               var $animatable = $(this);
                    if (($animatable.offset().top + $animatable.height() - 20) < offset) {
                $animatable.removeClass('animatable').addClass('animated');
                    }
            });
      
            };
          
          // Hook doAnimations on scroll, and trigger a scroll
            $(window).on('scroll', doAnimations);
          $(window).trigger('scroll');
          winWidth = window.innerWidth;
            if (winWidth > 900){
              $("#floating-cta").removeClass('l-0');
            } 
      
          $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
      
             //>=, not <=
            if (scroll > 200) {
                //clearHeader, not clearheader - caps H
                $("#header-arrow").fadeOut();
            }else{$("#header-arrow").fadeIn();}
      
        }); //missing );
        */

});

/*stops video when lightbox closes*/
$("#content").on('click', '[data-dismiss="modal"], .modal', function() {
    $('.youtube-vid').each(function() {
        var el_src = $(this).attr("src");
        var src = el_src.replace(';&autoplay=1', '');
        $(this).attr("src", src);
    });
});

/*autoplays video when lightbox opens*/
$("#content").on('click', '[data-toggle="modal"]', function() {
    var vid = $(this).closest('.card').siblings('.modal').find('.youtube-vid');
    $(vid).each(function() {
        var el_src = $(this).attr("src");
        $(this).attr("src", el_src + ';&autoplay=1;');
    });
});

/* YouTube support */
document.addEventListener("DOMContentLoaded",
    function() {
        var div, n,
            v = document.getElementsByClassName("youtube-player");
        for (n = 0; n < v.length; n++) {
            div = document.createElement("div");
            div.setAttribute("data-id", v[n].dataset.id);
            div.innerHTML = labnolThumb(v[n].dataset.id);
            div.onclick = labnolIframe;
            v[n].appendChild(div);
        }
    });

function labnolThumb(id) {
    var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
        play = '<div class="play"></div>';
    return thumb.replace("ID", id) + play;
}

function labnolIframe() {
    var iframe = document.createElement("iframe");
    var embed = "https://www.youtube.com/embed/ID?autoplay=1&amp;rel=0&amp;controls=1&amp;showinfo=1&amp;wmode=opaque&amp;enablejsapi=1";
    iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
    iframe.setAttribute("frameborder", "0");
    iframe.setAttribute("allowfullscreen", "1");
    this.parentNode.replaceChild(iframe, this);
}

//
//delays loading of youtube embedded videos
function init() {
    var vidDefer = document.getElementsByTagName('iframe');
    for (var i = 0; i < vidDefer.length; i++) {
        if (vidDefer[i].getAttribute('data-src')) {
            vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
        }
    }
}
window.onload = init;

/* end YouTube support */

/* activate transforming top nav */
// When the user scrolls down 30px from the top of the document, slide down the navbar
/*window.onscroll = function() { scrollFunction() };  

function scrollFunction() {
    if (document.body.scrollTop > 70 || document.documentElement.scrollTop > 70) {
        document.getElementById("navbar-dropin").style.top = "0px";
        document.getElementById("navbar-dropin").classList.add("ie-dropin"); // fix for ie 11 
    } else {
        document.getElementById("navbar-dropin").style.top = "-60px";
        document.getElementById("navbar-dropin").classList.remove("ie-dropin");
    }
}
*/
/* end activate transforming top nav */


/**
 * Minified by jsDelivr using Terser v3.14.1.
 * Original file: /npm/js-cookie@2.2.1/src/js.cookie.js
 * 
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
! function(e) {
    var n;
    if ("function" == typeof define && define.amd && (define(e), n = !0), "object" == typeof exports && (module.exports = e(), n = !0), !n) {
        var t = window.Cookies,
            o = window.Cookies = e();
        o.noConflict = function() { return window.Cookies = t, o }
    }
}(function() {
    function e() { for (var e = 0, n = {}; e < arguments.length; e++) { var t = arguments[e]; for (var o in t) n[o] = t[o] } return n }

    function n(e) { return e.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent) }
    return function t(o) {
        function r() {}

        function i(n, t, i) {
            if ("undefined" != typeof document) {
                "number" == typeof(i = e({ path: "/" }, r.defaults, i)).expires && (i.expires = new Date(1 * new Date + 864e5 * i.expires)), i.expires = i.expires ? i.expires.toUTCString() : "";
                try { var c = JSON.stringify(t); /^[\{\[]/.test(c) && (t = c) } catch (e) {}
                t = o.write ? o.write(t, n) : encodeURIComponent(String(t)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), n = encodeURIComponent(String(n)).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent).replace(/[\(\)]/g, escape);
                var f = "";
                for (var u in i) i[u] && (f += "; " + u, !0 !== i[u] && (f += "=" + i[u].split(";")[0]));
                return document.cookie = n + "=" + t + f
            }
        }

        function c(e, t) {
            if ("undefined" != typeof document) {
                for (var r = {}, i = document.cookie ? document.cookie.split("; ") : [], c = 0; c < i.length; c++) {
                    var f = i[c].split("="),
                        u = f.slice(1).join("=");
                    t || '"' !== u.charAt(0) || (u = u.slice(1, -1));
                    try {
                        var a = n(f[0]);
                        if (u = (o.read || o)(u, a) || n(u), t) try { u = JSON.parse(u) } catch (e) {}
                        if (r[a] = u, e === a) break
                    } catch (e) {}
                }
                return e ? r[e] : r
            }
        }
        return r.set = i, r.get = function(e) { return c(e, !1) }, r.getJSON = function(e) { return c(e, !0) }, r.remove = function(n, t) { i(n, "", e(t, { expires: -1 })) }, r.defaults = {}, r.withConverter = t, r
    }(function() {})
});
//# sourceMappingURL=/sm/b0ce608ffc029736e9ac80a8dd6a7db2da8e1d45d2dcfc92043deb2214aa30d8.map

/* UTM tracking cookie support */

// Parse the URL
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
// Give the URL parameters variable names
var source = getParameterByName('utm_source');
var medium = getParameterByName('utm_medium');
var campaign = getParameterByName('utm_campaign');
var keyword = getParameterByName('keyword');

// Set the cookies
if (source != null && source != "") {
    Cookies.set('utm_source', source, { expires: 30 });
}
if (campaign != null && campaign != "") {
    Cookies.set('utm_campaign', campaign, { expires: 30 });
}
if (medium != null && medium != "") {
    Cookies.set('utm_medium', medium, { expires: 30 });
}
if (keyword != null && keyword != "") {
    Cookies.set('keyword', keyword, { expires: 30 });
}

// Grab the cookie value and set the form field values
$(document).ready(function() {
    var mediumValue = Cookies.get('utm_medium');
    var campaignValue = Cookies.get('utm_campaign');
    var sourceValue = Cookies.get('utm_source');
    var keywordValue = Cookies.get('keyword');

    if (mediumValue != null && mediumValue !== "" && document.getElementById('medium') !== null) {
        document.getElementById("medium").value = mediumValue;
    }
    if (sourceValue != null && sourceValue !== "" && document.getElementById('source') !== null) {
        document.getElementById("source").value = sourceValue;
    }
    if (campaignValue != null && campaignValue !== "" && document.getElementById('campaign') !== null) {
        document.getElementById("campaign").value = campaignValue;
    }
    if (keywordValue != null && keywordValue !== "" && document.getElementById('keyword') !== null) {
        document.getElementById("keyword").value = keywordValue;
    }
});
/* end UTM tracking cookie support */

/* phone tracking */
/* 
function CallEventLocation() {
    $('.loc-phone').each(function() {
        var winWidth = $(window).width();
        if (winWidth >= 768) {
            var shortNumber = $(this).text().substring(0, $(this).text().length - 4);
            $(this).text(shortNumber + " " + "[click to show]");


            $(this).one("click", function(event) {
                event.preventDefault();
                $(this).text($(this).attr('href').split(':')[1]);
                var locationInfo = $(this).closest('.hoag-location').find('.card-title').text() + " " + $(this).attr('href').split(':')[1];
                //console.log(locationInfo);
                ga('send', 'event', 'call', 'click-to-show', locationInfo);
            });

            $(this).click(function(e) {

                e.preventDefault();
            });


        } else {
            $(this).click(function() {


                $(this).text($(this).attr('href').split(':')[1]);
                var locationInfo = $(this).closest('.hoag-location').find('.card-title').text() + " " + $(this).attr('href').split(':')[1];
                //console.log(locationInfo);
                ga('send', 'event', 'call', 'click-to-call', locationInfo);
            });
        }
    });
}

function CallEventOffice() {
    $('.dr-phone').each(function() {
        var winWidth = $(window).width();
        if (winWidth >= 768) {
            if ($(this).text().length === 14) {
                var shortNumber = $(this).text().substring(0, $(this).text().length - 4);
                $(this).text(shortNumber + " " + "[click to show]");
            }

            if ($(this).text().length === 18) {
                var shortNumber = $(this).text().substring(0, $(this).text().length - 8);
                $(this).text(shortNumber + " " + "[click to show]");
            }

            $(this).one("click", function(event) {

                event.preventDefault();

                $(this).text($(this).attr('href').split(':')[1]);
                var drInfo = $(this).closest('.physician-single').find('.physician-info-title').text() + " " + $(this).attr('href').split(':')[1];
                //console.log(drInfo);
                ga('send', 'event', 'call', 'click-to-show', drInfo);
            });

            $(this).click(function(e) {

                e.preventDefault();
            });
        } else {
            $(this).click(function() {
                // if(winWidth > 768){e.preventDefault();}	 
                $(this).text($(this).attr('href').split(':')[1]);
                var drInfo = $(this).closest('.physician-single').find('.physician-info-title').text() + " " + $(this).attr('href').split(':')[1];
                //console.log(drInfo);
                ga('send', 'event', 'call', 'click-to-call', drInfo);
            });
        }
    });
}

function CallEventLandingPage() {
    $('.click-to-show').each(function() {
        var winWidth = $(window).width();
        if (winWidth >= 768) {
            var shortNumber = $(this).text().substring(0, $(this).text().length - 4);
            $(this).text(shortNumber + " " + "[click to show]");


            $(this).one("click touchstart", function(event) {
                event.preventDefault();
                $(this).text($(this).attr('href').split(':')[1]);
                var label = document.title;

                ga('send', 'event', 'call', 'click-to-show', label);
            });

            $(this).click(function(e) {

                e.preventDefault();
            });


        } else {
            $(this).click(function() {


                $(this).text($(this).attr('href').split(':')[1]);
                var label = document.title;

                ga('send', 'event', 'call', 'click-to-show', label);
            });
        }
    });
}

$(document).ready(function() {
    setTimeout(CallEventLandingPage, 1000);
    setTimeout(CallEventOffice, 1000);
    setTimeout(CallEventLocation, 1000);
});
 */

/*new call tracking*/
/* var links = $("a").get();

links.forEach(link => {
    var eventLabel = $(link).attr('id');
    if (typeof eventLabel == 'undefined') {
        var eventLabel = document.title;
    }
    if ($(link).attr('href') !== undefined) {
        if ($(link).attr('href').includes('tel:') && !$(link).hasClass('cts-override')) {
            var winWidth = $(window).width();
            if (winWidth >= 768) {
                var shortNum = $(link).text().substring(0, $(link).text().length - 4);
                $(link).text(shortNum + "[click to show]");
                //the click
                $(link).one("click", function(event) {
                    event.preventDefault();
                    $(this).text($(this).attr('href').split(':')[1]);
                    ga('send', 'event', 'call', 'click-to-show', eventLabel);
                });
                $(link).click(function(e) { e.preventDefault(); });
            } else {
                $(link).click(function() {
                    ga('send', 'event', 'call', 'click-to-call', eventLabel);
                });
            }
        }
    }
}); */

/* end phone tracking */

/* ClockwiseMD goal tracking */
/* function ClockwiseEvent() {
    $('.clockwise-btn').each(function() {
        $(this).click(function(e) {
            var locationInfo = $(this).closest('.hoag-location').find('.card-title').text();
            console.log(locationInfo);
            ga('send', 'event', 'appointment', 'reserve-uc', locationInfo);
        });

    });
}

$(document).ready(function() {
    setTimeout(ClockwiseEvent, 1000);
}); */
/* end ClockwiseMD goal tracking */

/*Class customizations */
$(document).ready(function() {
    $(".em-booking-submit").addClass("btn btn-primary");
    $('.input-user-field input').addClass('form-control');
    $('.input-text').addClass('d-block');
    $('.input-text input').addClass('form-control');
});
/* End class customizations */

/*Show More Button */
$(document).ready(function() {
    $(".btn-overflow").click(function(e) {
        e.stopPropagation();
        e.preventDefault();

        var btn = $(this);
        var content = $(this).parent().prev('.content-overflow');
        var h = content[0].scrollHeight * 1.0;
        var windowsize = $(window).width();

        if (windowsize > 575) {
            if (btn.hasClass('less')) {
                btn.removeClass('less');
                btn.addClass('more');
                btn.html('Show less &uarr;');
                content.removeClass('content-fade-desktop');
                content.animate({ 'height': h });
            } else {
                btn.addClass('less');
                btn.removeClass('more');
                btn.html('Show more &darr;');
                content.animate({ 'height': '500px' });
                content.addClass('content-fade-desktop');
            }
        } else {
            if (btn.hasClass('less')) {
                btn.removeClass('less');
                btn.addClass('more');
                btn.html('Show less &uarr;');
                content.removeClass('content-fade');
                content.animate({ 'height': h });
            } else {
                btn.addClass('less');
                btn.removeClass('more');
                btn.html('Show more &darr;');
                /* content.animate({ 'max-height': '500px' }); */
                content.addClass('content-fade');
            }
        }
    })
});
/* End Show More Button */


$('.showmore').click(function() {
    $('.hide').toggle();
    $('.hide-sm').toggle();
});

$(".filter").click(function() {
    $('.hide').toggle();
    $('.hide-sm').toggle();
    $(this).toggleClass('active');
});


setTimeout(function() {
    var maxHeight = 0;
    var matchHeight = $(".location-card-title");
    if (typeof matchHeight !== 'undefined') {
        $(matchHeight).each(function() {
            if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
        });
        $(matchHeight).height(maxHeight);
    }



}, 300);


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;SameSite=Lax";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var pathArray = window.location.pathname.split('/');
    var location = pathArray;
    if (location[1] == 'physicians') {
        var cookie = getCookie("primarly-hoag");
        cookie == '' ? $('#fad-modal').modal('show') : null;
        if (cookie == 'hoag-primary-user') {
            $('input#primarily_hoag').attr({ name: 'primarily-hoag', value: 1 });
            $('#top-form').submit();
        };
        /* console.log(cookie); */

    }

}

$('#top-specialty').change(function(event) {
    event.preventDefault();
    checkCookie();
});


var primaryhoagdoc = $(".primarily-hoag");
var nonhoagdoc = $(".non-hoag");
$(primaryhoagdoc).click(function() {
    setCookie("primarly-hoag", "hoag-primary-user", 30);
    $('input#primarily_hoag').attr({ name: 'primarily-hoag', value: 1 });
    $('#top-form').submit();
});
$('input.form-check-input.primarily-hoag').click(function() {
    if ($(this).is(":not(:checked)")) {
        setCookie("primarly-hoag", '', 30);
    }
    checkCookie();
});

$(nonhoagdoc).click(function() {
    $('#top-form').submit();
});


var visibleY = function(el) {
    var rect = el.getBoundingClientRect(),
        top = rect.top,
        height = rect.height,
        el = el.parentNode;
    do {
        rect = el.getBoundingClientRect();
        if (top <= rect.bottom === false) return false;
        // Check if the element is out of view due to a container scrolling
        if ((top + height) <= rect.top) return false
        el = el.parentNode;
    } while (el != document.body);
    // Check its within the document viewport
    return top <= document.documentElement.clientHeight;
};

// Stuff only for the demo
function attachEvent(element, event, callbackFunction) {
    if (element.addEventListener) {
        element.addEventListener(event, callbackFunction, false);
    } else if (element.attachEvent) {
        element.attachEvent('on' + event, callbackFunction);
    }
};

//Floating CTA
var form = document.getElementById('contact-form');
/* console.log(form); */

if (form) {
    var update = function() {
        var scroll = $(window).scrollTop();
        if (visibleY(form)) {
            $('#floating-cta').fadeOut();
        } else {
            $('#floating-cta').fadeIn();
        }
    };

    attachEvent(window, "scroll", update);
    attachEvent(window, "resize", update);
    update();
}

// Scroll to content just above contact form on floating CTA click
$(document).ready(function() {
    var formHeader = $('#contact-form').prevAll('h2').first();
    $(formHeader).attr("id", 'contact-form-anchor');
});

$("#info").click(function() {
    $('#info-modal').modal('show');
});

/* youtube class video logic */
setInterval(function() {
    var video = $('#class-video');
    var img = $('#class-img');
    var od = $('#class-media').attr('on-demand');
    var start = $('#class-media').attr('start');
    var end = parseInt($('#class-media[end]').attr('end')) + 30;

    /*  console.log(end); */

    var currentdate = new Date();
    var datetime = currentdate.getDate() +
        (currentdate.getMonth() + 1) +
        currentdate.getFullYear() +
        currentdate.getHours() +
        currentdate.getMinutes() +
        currentdate.getSeconds();

    // For todays date;
    Date.prototype.today = function() {
        return this.getFullYear() + (((this.getMonth() + 1) < 10) ? "0" : "") + (this.getMonth() + 1) + ((this.getDate() < 10) ? "0" : "") + this.getDate();
    }

    // For the time now
    Date.prototype.timeNow = function() {
        return ((this.getHours() < 10) ? "0" : "") + this.getHours() + ((this.getMinutes() < 10) ? "0" : "") + this.getMinutes() + ((this.getSeconds() < 10) ? "0" : "") + this.getSeconds();
    }

    var newDate = new Date();
    var now = newDate.today() + newDate.timeNow();

    if (od == 1) {
        video.removeClass('d-none');
        img.addClass('d-none');

    } else {
        if (now <= end) {
            video.removeClass('d-none');
            img.addClass('d-none');
        } else {
            video.addClass('d-none');
            img.removeClass('d-none');

        }
    }

}, 1000);

/* end youtube class video logic */

/* scrolling anmations*/


var anims = [
    { "class": ".fadein", "effect": 'fadein 0.8s forwards ease-out' },
    { "class": ".slideup", "effect": 'fadein  0.8s forwards ease-out' },
    { "class": ".slideleft", "effect": 'fadein  0.8s forwards ease-out' },
    { "class": ".slideright", "effect": 'fadein  0.8s forwards ease-out' }
    /*     { "class": "h1", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "h2", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "h3", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "h4", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "h5", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "h6", "effect": 'fadein  0.8s forwards ease-out' },
        { "class": "p", "effect": 'fadein  0.8s forwards ease-out' } */
];


anims.forEach(anim => {
    $(document).ready(function() {
        const sections = $(anim.class);
        for (let section of sections) {
            var c = section.getBoundingClientRect().top;
            if (c <= window.innerHeight) {
                try {
                    if (section != 'null') {
                        section.style.animation = anim.effect;
                        /*                         section.style.animation = null;
                                                var el = anim.class.replace('.', '');
                                                $(section).delay(2000).removeClass(el); */
                    }
                } catch (error) {}
            }
        }
    });

    $(document).ajaxComplete(function() {
        const sections = $(anim.class);
        for (let section of sections) {
            var c = section.getBoundingClientRect().top;
            if (c <= window.innerHeight) {
                try {
                    if (section != 'null') {
                        section.style.animation = anim.effect;
                        setTimeout(() => {
                            section.style.animation = null;
                            var el = anim.class.replace('.', '');
                            $(section).removeClass(el);
                        }, 1000);

                    }
                } catch (error) {}
            }
        }
    });
    $(window).scroll(function() {
        const sections = $(anim.class);
        for (let section of sections) {
            var c = section.getBoundingClientRect().top;
            if (c <= window.innerHeight * 0.8) {
                try {
                    if (section != 'null' && !status) {
                        section.style.animation = anim.effect;
                        setTimeout(() => {
                            section.style.animation = null;
                            var el = anim.class.replace('.', '');
                            $(section).removeClass(el);
                        }, 1000);
                    }
                } catch (error) {}
            }
        }
    });
});
/* table of contents functionality */

var contents = $('#toc');
if (contents.length) {
    var tos = contents.offset().top;

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (tos <= scroll) { $('#toc').addClass('md-shadow position-sticky t-0 align-self-start z-3'); } else { $('#toc').removeClass('md-shadow position-sticky t-0 z-3'); }

    });


    var ts = $('#toc li');
    var tu = $('#toc ul');
    /* $(ts[0]).addClass('bg-tertiary px-2 rounded link-white'); */
    const arr = [];
    var ind = 0;
    for (var i = 0, len = ts.length; i < len; i++) {
        var s = ts[i];
        arr.push({ 'ind': ind++, 'val': s.offsetLeft, 'el': '#toc li' });
    }

    for (var i = 0, len = arr.length; i < len; i++) {
        let s = (arr[i].val);
        var t = $('#toc li')[arr[i].ind];
        $(t).click(function() {
            $(tu).animate({ scrollLeft: s - 160 }, 200);
            $(this).addClass('bg-tertiary text-white px-2 rounded link-white');
            $(this).siblings().removeClass('bg-tertiary text-white px-2 link-white');
        })
    }
}
/* end table of contents functionality */

$('.search-toggle').click(function() {
    $('.header-search').fadeToggle();
    $('#header').toggleClass('opacity-0');

    if ($('.header-search input').hasClass('focused')) {
        $('.header-search input').focusout();
        $('.header-search input').removeClass('focused');
    } else {
        $('.header-search input').focus();
        $('.header-search input').addClass('focused');
    }

});

$('#begin').click(function() {
    if ($('#header').hasClass('opacity-0')) {
        $('.header-search input').removeClass('focused');
        $('.header-search').fadeToggle();
        $('#header').toggleClass('opacity-0');
        $('.header-search input').focusout();

    }
});