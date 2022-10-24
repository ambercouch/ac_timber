/**
 * Created by Richard on 19/09/2016.
 */
console.log('ACTIMBER image loaded webfonts');
ACTIMBER = {
    common: {
        init: function () {

            var lastScrollTop = 0;
            var scrollTimer = null;
            var scrollTop = $(window).scrollTop();
            var scrolling = false
            var startScroll = false;
            var topHight = 200;

            if(scrollTop >= topHight){
                $('body').attr('data-pos-top', 'false')
                console.log('top = false')
            }else{
                $('body').attr('data-pos-top', 'true')
                console.log('top = true')
            }

            $(window).scroll(function() {

                scrollTop = $(this).scrollTop();

                if (startScroll === false) {
                    console.log("start scrolling")
                    startScroll = true;
                    if(scrollTop >= topHight){
                        $('body').attr('data-pos-top', 'false')
                        console.log('top = false')
                    }else{
                        $('body').attr('data-pos-top', 'true')
                        console.log('top = true')
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
                            console.log('top = false')
                        }else{
                            $('body').attr('data-pos-top', 'true')
                            console.log('top = true')
                        }
                    }, 200);

                }

                if (scrollTimer) {
                    clearTimeout(scrollTimer);   // clear any previous pending timer
                }

                scrollTimer = setTimeout(function () {
                    console.log("not scrolling")
                    startScroll = false;
                    lastScrollTop = scrollTop;
                    if(scrollTop >= topHight-){
                        $('body').attr('data-pos-top', 'false')
                        console.log('top = false')
                    }else{
                        $('body').attr('data-pos-top', 'true')
                        console.log('top = true')
                    }
                }, 200);   // set new timer



            }); //missing );


            'use strict';
            //uncomment to debug
            console.log('common');

            //add js class
            jQuery('body').addClass('js');
            jQuery('body').removeClass('no-js');
            //$("[data-fitvid]").fitVids();

            fitvids();

            ACTIMBER.fn.actScrollLink();



            if(typeof acf !== 'undefined'){
                if( acf.fields.color_picker ) {
                    // custom colors
                    var palette = ['#111111', '#333333', '#555555', '#777777', '#999999', '#cccccc'];

                    // when initially loaded find existing colorpickers and set the palette
                    acf.add_action('load', function() {
                        $('input.wp-color-picker').each(function() {
                            $(this).iris('option', 'palettes', palette);
                        });
                    });

                    // if appended element only modify the new element's palette
                    acf.add_action('append', function(el) {
                        $(el).find('input.wp-color-picker').iris('option', 'palettes', palette);
                    });
                }
            }




            const podcastSlider = document.querySelector('.l-post-thumb-list__list--slides');


            if(podcastSlider != null){
                const flktyGallery = new Flickity( podcastSlider, {
                    // options
                    cellAlign: 'left',
                    contain: true,
                    imagesLoaded: true,
                });
            }




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
    blog: {
        init: function () {
            //load the blogs
            ACTIMBER.fn.actLoadBlogs();
        }

    },
    archive: {
        init: function(){

        },
        category: function () {
            ACTIMBER.fn.actLoadBlogs();
        }
    },
    fn: {
        open: function (container, showButton, parent, pd  ) {

            //console.log('pd1');
            //console.log(pd);

            pd = (pd === 'undefined' ) ? true : pd;

            var elState = showButton.attr('data-state');
            var eventActOpen = new Event('actOpen');
            var eventActClose = new Event('actClose');
            var containId = container.attr('data-container')
            showButton.on('click', function (e) {
                if(pd === true){
                    e.preventDefault();
                }
                elState = showButton.attr('data-state');
                if ('off' === elState) {
                    console.log('off click')
                    showButton.attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('is-state-on');
                    document.body.className += ' container-is-open ' + 'container-open-' + containId ;
                    window.dispatchEvent(eventActOpen)

                } else {
                    console.log('NOT off click')
                    //console.log(document.body.className)
                    $(showButton).attr('data-state', 'off');
                    $(container).attr('data-state', 'off');
                    $(parent).attr('data-state', 'off');
                    $(container).removeClass('is-state-on');
                    document.querySelector('body').classList.remove('container-is-open');
                    document.querySelector('body').classList.remove('container-open-' + containId);

                    window.dispatchEvent(eventActClose);
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
                // console.log('elState');
                // console.log(this);
                //
                // console.log(elState);

                if ('off' === elState ) {
                    // console.log('click on');
                    $(this).attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('ac-on');
                    document.body.className += ' ' + 'container-is-open';
                    window.dispatchEvent(eventActOpen);

                } else {
                    // console.log('click off');
                    $(this).attr('data-state', 'off');
                    $(container).attr('data-state', 'off');
                    $(parent).attr('data-state', 'off');
                    $(container).removeClass('ac-on');
                    document.querySelector('body').classList.remove('container-is-open');

                    window.dispatchEvent(eventActClose);
                }
            });
        },
        actDefer: function (successMethod, failMethod, testMethod, pause, attempts) {
            var defTest = function () {

                if (typeof jQuery !== 'undefined') {
                    return true
                }
                return false;

            };
            //What to do if test is false
            var defFail = function () {
                console.log('The deftest failed');
            }
            //What to do if test is true
            var defSuccess = function () {
                console.log('The deftest passed');
            }
            attempts = (attempts === undefined) ? false : attempts;
            pause = (pause === undefined) ? 50 : pause;
            testMethod = (testMethod === undefined) ? defTest : testMethod;
            failMethod = (failMethod === undefined) ? defFail : failMethod;
            successMethod = (successMethod === undefined) ? defSuccess : successMethod;


            if (testMethod()) {
                console.log('the testmethod')
                successMethod();
            } else {
                console.log('the failmethod')
                failMethod();
                if (attempts === false || attempts > 0) {
                    setTimeout(function () {
                        attempts = (attempts === false) ? attempts : attempts - 1;
                        ACTIMBER.fn.actDefer(successMethod, failMethod, testMethod, pause, attempts)
                    }, pause);
                }
            }
        },
        actLoadBlogs: function(selectors = 'undefined'){

            if (selectors == "undefined"){
                selectors = {
                    'control' : '[data-load-more]',
                    'container' : '.l-post-thumb-list__list--blog',
                }
            }

            $(document).on('click', selectors.control , function () {

                var urlOrign = window.location.origin

                //Pathname without the trailing slash
                var urlPath = window.location.pathname.replace(/\/$/, '');

                //get the path and see if it is already paged eg /page/2
                var urlPathArray = urlPath.split('/');
                var urlPathLength = urlPathArray.length
                var urlPageMarker = urlPathArray[urlPathLength - 2]


                if(urlPageMarker == 'page'){
                    //if paged get the next page url
                    var urlPageNum = urlPathArray[urlPathLength - 1]
                    var urlPageNext = parseInt(urlPageNum) + 1;

                    var urlUpdate= urlOrign + urlPath.substring(0, urlPath.lastIndexOf('/')) + '/' + urlPageNext + '/';

                }else{
                    //if not paged get the second page url
                    var urlUpdate= urlOrign + urlPath + '/page/2/';

                }

                var button = $(this),

                    data = {
                        'action': 'loadmore',
                        'query': ac_timber_params.posts, // that's how we get params from wp_localize_script() function
                        'page' : ac_timber_params.current_page
                    };

                // console.log('senddata');
                // console.log(data);

                selectors.container = button.attr('data-container-selector') ?  button.attr('data-container-selector') : selectors.container;

                $.ajax({ // you can also use $.post here
                    url : ac_timber_params.ajaxurl, // AJAX handler
                    data : data,
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.addClass('is-loading')
                    },
                    success : function( data ){
                        if( data ) {

                            //console.log('data');
                            // console.log(data);

                            history.pushState({},"URL Rewrite Example",urlUpdate )

                            $(selectors.container).append(data);
                            button.removeClass('is-loading')
                            ac_timber_params.current_page++;

                            if (ac_timber_params.current_page == ac_timber_params.max_page )
                                button.remove(); // if last page, remove the button

                            // you can also fire the "post-load" event here if you use a plugin that requires it
                            // $( document.body ).trigger( 'post-load' );

                        } else {
                            button.remove(); // if no data, remove the button as well

                        }
                    }
                });

            })
        },
        actScrollLink: function () {

            $(document).on('click', '[data-scroll]', function (e) {
                e.preventDefault();
                let $clicker = $(this);
                let targetID = $clicker.attr('href');
                let $target = $(targetID);

                $('html, body').animate({ scrollTop: $target.offset().top}, 1000 );
            })

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
