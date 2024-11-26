/**
 * Created by Richard on 19/09/2016.
 */

console.log('ACTIMBER state');
ACTIMBER = {
    common: {
        init: function () {
            'use strict';
            //uncomment to debug
            console.log('common');

            //add js class
            jQuery('body').addClass('js');
            //$("[data-fitvid]").fitVids();

            fitvids();

            ACTIMBER.fn.actSmartMastheader();
            ACTIMBER.fn.actMastheadPadding();

            $('[data-control]:not([data-control-radio])').each(function() {
                console.log("data cons")

                const containerId = $(this).attr('data-control');
                const controlSelector = (containerId != '' )? '[data-control='+ containerId + ']' : this;
                const control = $(controlSelector);
                const controlGroupId = control.attr('data-state-group');
                const containerSelector = (containerId != '' )? '[data-container='+ containerId + ']' : $(this).closest('[data-container]');
                const container = $(containerSelector);

                control.off('click');

                control.on('click',  function (e) {
                    console.log('clickered');
                    const state = control.attr('data-state');
                    e.preventDefault();

                    ACTIMBER.fn.actStateToggleSelect(control, state);



                    if(state == 'on'){
                        $('body').addClass('has-' + containerId + '-off')
                        $('body').removeClass('has-' + containerId + '-on')
                    }else{
                        $('body').addClass('has-' + containerId + '-on')
                        $('body').removeClass('has-' + containerId + '-off')
                    }

                    if (controlGroupId){
                        console.log('clickered group');
                        ACTIMBER.fn.actStateToggleGroup(control, controlGroupId, state);
                        ACTIMBER.fn.actStateToggleSelect(container, state);

                    }else{
                        console.log('clickered not group');
                        ACTIMBER.fn.actStateToggleSelect(container, state);
                    }
                });

            });


            /*
             * Add body class when flickity instance is ready
             * Use the class to style flickity cell and make the equal hight
             * .flickity-elementID-loaded .flickity-slider > *{height 100%}
             * *Without the late loaded body class flickty will calculate the height as 0px
             */
            let carousels = document.querySelectorAll('[data-flickity]');

            carousels.forEach(carousel => {
                let flkty = Flickity.data(carousel);

                if (flkty) {
                    if (flkty.isActive) {
                        // If Flickity is already active, add the class immediately
                        document.body.classList.add(`flickity-${carousel.id}-loaded`);
                    } else {
                        // Attach listener if it's not yet ready
                        flkty.on('ready', function () {
                            document.body.classList.add(`flickity-${carousel.id}-loaded`);
                        });
                    }
                } else {
                    console.error(`Flickity instance not found for carousel with ID: ${carousel.id}`);
                }
            });




            var elem = document.querySelector('.c-gallery-slider');

            if (elem){
                var flkty = new Flickity( elem, {
                    // options
                    cellAlign: 'left',
                    contain: true,
                    imagesLoaded: true,
                    pageDots:(elem.dataset.dotNav)? true: false,
                    prevNextButtons: (elem.dataset.arrowNav)? true: false,
                    autoPlay: (elem.dataset.autoPlay)? +elem.dataset.autoPlay: false,
                });

            }



            /**
             * navigation.js
             *
             * Handles toggling the navigation menu for small screens.
             */
            //( function() {
            //  var container, button, menu;
            //
            //  container = document.getElementById( 'main-navigation' );
            //  if ( ! container ) {
            //    return;
            //  }
            //
            //
            //  button = test;//document.getElementsByClassName( 'responsive-toggle' )[0];
            //  if ( 'undefined' === typeof button ) {
            //    button = container.querySelectorAll('.responsive-toggle')[0]
            //  }
            //  if ( 'undefined' === typeof button ) {
            //    return;
            //  }
            //
            //  menu = container.getElementsByTagName( 'ul' )[0];
            //
            //  // Hide menu toggle button if menu is empty and return early.
            //  if ( 'undefined' === typeof menu ) {
            //    button.style.display = 'none';
            //    return;
            //  }
            //
            //  menu.setAttribute( 'aria-expanded', 'false' );
            //
            //  if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
            //    menu.className += ' nav-menu';
            //  }
            //
            //  button.onclick = function() {
            //    if ( -1 !== container.className.indexOf( 'toggled' ) ) {
            //      container.className = container.className.replace( ' toggled', '' );
            //      button.setAttribute( 'aria-expanded', 'false' );
            //      menu.setAttribute( 'aria-expanded', 'false' );
            //    } else {
            //      container.className += ' toggled';
            //      button.setAttribute( 'aria-expanded', 'true' );
            //      menu.setAttribute( 'aria-expanded', 'true' );
            //    }
            //  };
            //} )();


        }
    },
    page: {
        init: function () {
            //uncomment to debug
            //console.log('pages');
        }
    },
    post: {
        init: function () {
            //uncomment to debug
            //console.log('posts');
        }
    },
    fn: {
        actSliderLayout : function () {
            $('[data-slider]').each(function (i) {
                var $slider = $(this);
                var $slides = $slider.find('[data-slider-item]');
                var sliderHeight = $slider.find('[data-slider-item]').outerHeight();
                var sliderWidth = $slider.outerWidth();
                var sliderWindow = $slider.find('[data-slider-window]');
                var sliderWindowWidth = sliderWindow.outerWidth();
                var $sliderList = $slider.find('[data-slider-list]');
                var currentItem = parseInt( $('[data-slider-active]', this).attr('data-slider-active'));
                var posTop = sliderHeight - (sliderHeight * currentItem);
                var posLeft = sliderWidth - (sliderWidth * currentItem);
                var newItem = currentItem - 1;
                var slideDirection = 'vert';

                if($slider.hasClass('is-horizontal'))
                {
                    $slides.css('width', sliderWindowWidth);
                    console.log('slider win width' + sliderWindowWidth);
                    console.log('is-horizontal');
                    slideDirection = 'horiz';

                }else{
                    console.log('not-horizontal')
                }

                if (slideDirection === 'horiz'){
                    //console.log('direction horiz');

                    var listWidth = sliderWindowWidth * $slides.length;
                    $sliderList.css('width',  listWidth);
                    $sliderList.css('left' , posLeft);

                }else {
                    console.log('direction vert');
                    $sliderList.css('top' , posTop);
                }

                console.log('$slides.length');
                console.log($slides.length);

                $slides.first().attr('data-active', 'on');

                console.log('sliderHeight');
                console.log(sliderHeight);



                //prev control
                $(document).on('click', '.slider-scroll__btn--prev, .slider-nav__btn--nav-prev', function () {
                    console.log('click prev');

                    newItem = currentItem - 1;

                    if (newItem > 0){

                        $('[data-active=on]').attr('data-active', 'off');
                        $('[data-slider-active]').attr('data-slider-active', newItem);
                        $('[data-slider-item='+newItem+']').attr('data-active', 'on');
                        $('[data-slide-nav='+newItem+']').attr('data-active', 'on');

                        //set the active slide slide ID on the slide list
                        $sliderList.attr('data-slider-active',newItem);

                        // Set the matching slide item to active
                        $sliderList.find('[data-slider-active='+newItem+']').attr('data-active', 'on')

                        //reposition the slider list
                        posTop = sliderHeight - (sliderHeight * newItem);
                        posLeft = sliderWindowWidth - (sliderWindowWidth * newItem);
                        if(slideDirection === 'vert'){
                            $sliderList.css('top' , posTop);

                        }else {
                            $sliderList.css('left' , posLeft);
                        }
                        currentItem = newItem;
                    }
                });

                //next control
                $(document).on('click', '.slider-scroll__btn--next, .slider-nav__btn--nav-next', function () {
                    console.log('click next');

                    newItem = currentItem + 1;

                    if (newItem <= $slides.length){

                        $('[data-active=on]').attr('data-active', 'off');
                        $('[data-slider-active]').attr('data-slider-active', newItem);
                        $('[data-slider-item='+newItem+']').attr('data-active', 'on');
                        $('[data-slide-nav='+newItem+']').attr('data-active', 'on');

                        //set the active slide slide ID on the slide list
                        $sliderList.attr('data-slider-active',newItem);

                        // Set the matching slide item to active
                        $sliderList.find('[data-slider-active='+newItem+']').attr('data-active', 'on')

                        //reposition the slider list
                        posTop = sliderHeight - (sliderHeight * newItem);
                        posLeft = sliderWindowWidth - (sliderWindowWidth * newItem);
                        if(slideDirection === 'vert'){
                            $sliderList.css('top' , posTop);

                        }else {
                            $sliderList.css('left' , posLeft);
                        }
                        currentItem = newItem;
                    }
                });

                $(document).on('click', '[data-slide-nav]', function () {

                    //set current active slide to off
                    $('[data-active=on]').attr('data-active', 'off');

                    $(this).attr('data-active','on');

                    //Get the ID of the click nav link
                    currentItem = $(this).attr('data-slide-nav');

                    //set the active slide slide ID on the slide list
                    $sliderList.attr('data-slider-active',currentItem);

                    // Set the matching slide item to active
                    $sliderList.find('[data-slider-item='+currentItem+']').attr('data-active', 'on')

                    //reposition the slider list
                    posTop = sliderHeight - (sliderHeight * currentItem);
                    posLeft = sliderWindowWidth - (sliderWindowWidth * currentItem);
                    if(slideDirection === 'vert'){
                        $sliderList.css('top' , posTop);

                    }else {
                        $sliderList.css('left' , posLeft);
                    }

                    $('[data-slider-active]').attr('data-slider-active', currentItem);

                })

            })

        },
        actElDimensions: function (selector) {
            if (selector == undefined){
                selector = 'html';
            }

            return {
                width : $(selector).outerWidth(),
                height : $(selector).outerHeight(),
            }
        },
        actScrollTo : function (offSet) {

            if(offSet == undefined){
                offSet = 0;
            }

            $('a[href*="#"]:not([href="#"])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top - offSet
                        }, 1000);
                        return false;
                    }
                }
            });

        },
        actStateToggleSelect : function (element, state) {
            if('off' === state ){
                element.attr('data-state', 'on');
            }
            if('on' === state){
                element.attr('data-state', 'off');
            }
        },
        actStateToggle: function (container, showButton, parent, listParent) {
            var elState = showButton.attr('data-state');
            var eventActOpen = new Event('actOpen');
            var eventActClose = new Event('actClose');
            showButton.on('click', function(e){
                e.preventDefault();
                elState = $(this).attr('data-state');
                if ('off' === elState ) {
                    console.log('click on');
                    $(this).attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('ac-on');
                    document.body.className += ' ' + 'container-is-open';
                    window.dispatchEvent(eventActOpen);

                } else {
                    console.log('click off');
                    $(this).attr('data-state', 'off');
                    $(container).attr('data-state', 'off');
                    $(parent).attr('data-state', 'off');
                    $(container).removeClass('ac-on');
                    document.querySelector('body').classList.remove('container-is-open');
                    window.dispatchEvent(eventActClose);
                }
            });
        },
        actDefer: function(successMethod, failMethod, testMethod, pause, attempts) {
            var defTest = function () {

                if (typeof jQuery !== 'undefined') {
                    return true
                }
                return false;

            };
            //What to do if test is false
            var  defFail = function () {
                console.log('The deftest failed');
            }
            //What to do if test is true
            var  defSuccess = function () {
                console.log('The deftest passed');
            }
            attempts = (attempts === undefined)? false : attempts;
            pause = (pause === undefined)? 50 : pause;
            testMethod = (testMethod === undefined)? defTest : testMethod;
            failMethod = (failMethod === undefined)? defFail : failMethod;
            successMethod = (successMethod === undefined)? defSuccess : successMethod;


            if (testMethod()) {
                console.log('the testmethod')
                successMethod();
            } else {
                console.log('the failmethod')
                failMethod();
                if(attempts === false || attempts > 0) {
                    setTimeout(function () {
                        attempts = (attempts === false )? attempts : attempts - 1;
                        ACTIMBER.fn.actDefer(successMethod, failMethod, testMethod, pause, attempts)
                    }, pause);
                }
            }
        },
        actSmartMastheader: function() {
            var lastScrollTop = 0;
            var scrollTimer = null;
            var scrollTop = $(window).scrollTop();
            var scrolling = false
            var startScroll = false;
            var topHight = 200;

            if(scrollTop >= topHight){
                $('body').attr('data-pos-top', 'false')
            }else{
                $('body').attr('data-pos-top', 'true')
            }

            $(window).scroll(function() {

                scrollTop = $(this).scrollTop();

                if (startScroll === false) {
                    startScroll = true;
                    if(scrollTop >= topHight){
                        $('body').attr('data-pos-top', 'false')
                    }else{
                        $('body').attr('data-pos-top', 'true')
                    }

                }

                if (scrolling === false) {
                    setTimeout(function () {
                        console.log("scrolling")
                        if (scrollTop > lastScrollTop){
                            //scrolling down
                            $('body').attr('data-scroll-direction', 'down')
                        } else {
                            //scrolling up
                            $('body').attr('data-scroll-direction', 'up')
                        }
                        if(scrollTop >= topHight){
                            $('body').attr('data-pos-top', 'false')
                        }else{
                            $('body').attr('data-pos-top', 'true')
                        }
                    }, 200);

                }

                if (scrollTimer) {
                    clearTimeout(scrollTimer);   // clear any previous pending timer
                }

                scrollTimer = setTimeout(function () {
                    startScroll = false;
                    lastScrollTop = scrollTop;
                    if(scrollTop >= topHight){
                        $('body').attr('data-pos-top', 'false')
                    }else{
                        $('body').attr('data-pos-top', 'true')
                    }
                }, 200);   // set new timer
            });
        },
        actMastheadPadding: function() {
            // Select the elements
            const masthead = document.querySelector('#masthead');
            const primary = document.querySelector('#primary.has-masthead-sticky,#primary.has-masthead-smart');

            // Function to set padding-top
            function adjustPadding() {
                const mastheadHeight = masthead.offsetHeight; // Get the height of the masthead
                primary.style.paddingTop = `${mastheadHeight}px`; // Set it as padding-top
            }

            // Run on page load
            adjustPadding();

            // Adjust on window resize
            window.addEventListener('resize', adjustPadding);
        }
    }
};

UTIL = {
    exec: function (template, handle) {
        var ns = ACTIMBER,
            handle = (handle === undefined) ? "init" : handle;

        if (template !== '' && ns[template] && typeof ns[template][handle] === 'function') {
            ns[template][handle]();
        }
    },
    init: function () {
        var body = document.body,
            template = body.getAttribute('data-post-type'),
            handle = body.getAttribute('data-post-slug');

        UTIL.exec('common');
        UTIL.exec(template);
        UTIL.exec(template, handle);
    }
};
jQuery(window).load(UTIL.init);
