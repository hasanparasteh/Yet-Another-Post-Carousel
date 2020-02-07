jQuery(document).ready(function ($) {
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 20,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});