var owl = $('#projects .images .owl-carousel');
owl.owlCarousel({
    center: true,
    autoPlay: true,
    singleItem: false,
    items: 3,
    loop: true,
    margin: 10,
    addClassActive: true,
    centerClass: 'center',
    dots: true,
    responsive: {
        0: {
            items: 1
        },
        1000: {
            items: 2
        }
    }
});