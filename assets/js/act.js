/**
 * Created by Richard on 12/05/2016.
 */

console.log('actjs');


$('.gallery__slides').flickity({
    initialIndex: 0,
    contain: true,
    // setGallerySize: true,
    imagesLoaded: true,
    cellAlign: 'center'
});

$('.gallery__controller').flickity({
    asNavFor: '.gallery__slides',
    contain: true,
    setGallerySize: false,
    pageDots: false
});


