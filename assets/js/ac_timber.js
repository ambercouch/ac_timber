ACT = {
    common: {
        init: function () {

            'use strict';
            console.log('common');

            $('.fitvid').fitVids();

            if ( ! Modernizr.objectfit ) {
                $('div[class^="feature-image"]').each(function () {
                    var $container = $(this),
                        imgUrl = $container.find('img').prop('src');
                    if (imgUrl) {
                        $container
                            .css('backgroundImage', 'url(' + imgUrl + ')')
                            .addClass('compat-object-fit');
                    }
                });
            }

            var showButton = document.getElementById('menuButton');
            var container = document.getElementById('primaryNavigation');
            ACT.ac_fn.open(container, showButton);

            var searchButton = document.getElementById('mastheadSearchBtn');
            var searchForm = document.getElementById('mastheadSearchForm');
            ACT.ac_fn.open(searchForm, searchButton);


            var ddMenus = document.getElementsByClassName('menu-item-has-children');
            var ddList;
            var itemid;

            [].forEach.call(ddMenus, function (e, i) {
                itemid = e.dataset.itemid;
                ddList = e.parentNode;
                var ddparent = e;
                var ddButton = document.getElementById('linkId' + itemid);
                var subMenu = document.getElementById('listId' + itemid);
                ACT.ac_fn.open(subMenu, ddButton, ddparent, ddList);
            });

            var drawers = document.getElementsByClassName('newsletter-drawer');
            var drawerButton = 'newsletter-drawer__title';
            var drawerContent = 'newsletter-drawer__content';
            ACT.ac_fn.open_collection( drawers, drawerButton, drawerContent);

        }
    },
    page: {
        init: function () {
            //uncomment to debug
            //console.log('pages');
        },
        events: function () {
            //console.log('events');

            var events = document.getElementsByClassName('event');
            var mapButton = 'btn--toggle-map';
            var map = 'event__map-container';

            ACT.ac_fn.open_collection(events, mapButton, map);

        },
        join_us: function () {
            //wpcf7-form-control
            //console.log('join us');
            var dropDown = document.getElementById('subInput');
            var textInput = document.getElementById('donationInput');
            var optionVal;

            dropDown.onchange = function(){
                switch(dropDown.options[dropDown.selectedIndex].index) {
                    case 0:
                        optionVal = '£0';
                        break;
                    case 1:
                        optionVal = '£5';
                        break;
                    case 2:
                        optionVal = '£7.50';
                        break;
                    case 3:
                        optionVal = '£10';
                        break;
                    default:
                        optionVal = '£0';
                }
                textInput.value = optionVal;
            };
        }
    },
    home: {
        init: function () {
            //uncomment to debug
            //console.log('posts');
        },
        blog: function () {

            $(function () {
                $('a[href*="#"]:not([href="#"])').click(function () {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            $('html, body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });
            });

            // var showButton, container;
            //
            // showButton = document.getElementById('menuButton');
            // container = document.getElementById('primaryNavigation');


            // var scrollTimer = null;
            // var acScrolling = false;
            // var acScrollTop = $(window).scrollTop();
            //
            // $(window).scroll(function () {
            //
            //     if (ACT.settings.acScrolling === false) {
            //         setTimeout(function () {
            //             ACT.ac_fn.startScroll(showButton);
            //         }, 200);
            //     }
            //
            //     if (scrollTimer) {
            //         clearTimeout(scrollTimer);   // clear any previous pending timer
            //     }
            //
            //     scrollTimer = setTimeout(function () {
            //         ACT.ac_fn.endScroll(showButton);
            //     }, 200);   // set new timer
            //
            // });

        }
    },
    ac_fn: {
        open: function (container, showButton, parent, listParent) {
            var elState = $(showButton).attr('data-state');
            showButton.onclick = function () {
                console.log('clicker');
                elState = $(showButton).attr('data-state');
                if ('off' === elState ) {
                    $(showButton).attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('ac-on');

                } else {
                    $(showButton).attr('data-state', 'off');
                    $(container).attr('data-state', 'off');
                    $(parent).attr('data-state', 'off');
                    $(container).removeClass('ac-on');
                }
            };
        },
        open_collection: function (collection, buttonClass, containerClass) {

            [].forEach.call(collection, function (e, i) {
                var buttons, containers, button, container;
                buttons = e.getElementsByClassName(buttonClass);
                containers = e.getElementsByClassName(containerClass);

                //console.log(mapButtons);
                if (buttons[0]) {
                    button = buttons[0];
                    container = containers[0];
                    ACT.ac_fn.open(container, button);
                }
            });

        },
        startScroll: function (showButton) {
            ACT.settings.acScrolling = true;
            var acScrollTop = $(window).scrollTop();

            console.log('startScroll()');
            if ($('#act_masthead').data('hidden') === true && acScrollTop >= 100) {
                $('#act_masthead').data('hidden', false);
                $('#act_masthead').attr('data-hidden', false);
            }
            if ($('#act_masthead').data('hidden') === false && acScrollTop <= 100 && showButton.dataset.state === 'off') {
                $('#act_masthead').data('hidden', true);
                $('#act_masthead').attr('data-hidden', true);
            }

        },
        endScroll: function (showButton) {
            ACT.settings.acScrolling = false;

            var acScrollTop = $(window).scrollTop();
            console.log('endScroll()');
            if ($('#act_masthead').data('hidden') === true && acScrollTop >= 100) {
                $('#act_masthead').data('hidden', false);
                $('#act_masthead').attr('data-hidden', false);
            }
            if ($('#act_masthead').data('hidden') === false && acScrollTop <= 100 && showButton.dataset.state === 'off') {
                $('#act_masthead').data('hidden', true);
                $('#act_masthead').attr('data-hidden', true);
            }
        }
    },
    settings: {
        acScrolling: false
    }
};
UTIL = {
    exec: function (template, handle) {
        var ns = ACT;

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


