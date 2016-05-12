/**
 * Created by Richard on 12/05/2016.
 */

console.log('actjs');


$('#gallery-1').flickity({
    initialIndex: 0,
    contain: true,
    // setGallerySize: true,
    imagesLoaded: true,
    cellAlign: 'center'
});

$('#gallery-2').flickity({
    asNavFor: '#gallery-1',
    contain: true,
    setGallerySize: false,
    pageDots: false
});
