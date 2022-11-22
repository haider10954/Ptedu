$(document).ready(function () {
    if ($(window).width() < 768) {
        var deviceWidth = $(window).width();
        $(".banner-content-inner img").width(deviceWidth);
        $(".banner-content-inner img").removeClass("img-fluid");
    }
    if ($(window).width() < 921) {
        $(".nav-link a").on("click", function () {
            $(this).siblings(".dropdown:first").slideToggle();
        });
        $(".dropdown-link a").on("click", function () {
            $(this).sibblings(".dropdown:first").slideToggle();
        });
    }
});

$(".has-megamenu").hover(
    function () {
        $("header").css({ "background-color": "#ffffff" });
    },

    function () {
        $("header").css({ "background-color": "#cdcecf" });
    }
);
