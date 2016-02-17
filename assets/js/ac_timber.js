ACT = {
    common: {
        init: function () {

            'use strict';
            //console.log('common');

            $('.fitvid').fitVids();

            var showButton = document.getElementById('menuButton');
            var container = document.getElementById('primaryNavigation');
            ACT.ac_fn.open(container, showButton);

            var searchButton = document.getElementById('mastheadSearchBtn');
            var searchForm = document.getElementById('mastheadSearchForm');
            ACT.ac_fn.open(searchForm, searchButton);


            var ddMenus = document.getElementsByClassName('menu-item-has-children');

            [].forEach.call(ddMenus, function(e,i) {
                var itemid = e.dataset.itemid;

                //console.log( e);

                //console.log(itemid);
                var ddButton = document.getElementById('linkId'+itemid);
                var subMenu = document.getElementById('listId'+itemid);
                ACT.ac_fn.open(subMenu, ddButton);
            });

        }
    },
    page: {
        init: function () {
            //uncomment to debug
            //console.log('pages');
        },
        events: function(){
            //console.log('events');
            var maps,map, mapButtons,mapButton, events;
            events = document.getElementsByClassName('event');

            //console.log(events);
            //console.log(mapButtons);

            [].forEach.call(events, function(e,i) {
                mapButtons = e.getElementsByClassName('btn--toggle-map');
                maps = e.getElementsByClassName('event__map-container');

                //console.log(mapButtons);
                if(mapButtons[0]) {
                    mapButton = mapButtons[0];
                    map = maps[0];
                    mapButton.onclick = function () {
                        if ('off' === mapButton.dataset.state) {
                            mapButton.dataset.state = 'on';
                            map.dataset.state = 'on';
                        } else {
                            mapButton.dataset.state = 'off';
                            map.dataset.state = 'off';
                        }
                    };
                }
            });

        }
    },
    home: {
        init: function () {
            //uncomment to debug
            //console.log('posts');
        },
        blog : function () {

            $(function() {
                $('a[href*="#"]:not([href="#"])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        if (target.length) {
                            $('html, body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });
            });

            var showButton, container;

            showButton = document.getElementById('menuButton');
            container = document.getElementById('primaryNavigation');

            showButton.onclick = function () {
                if ('off' === showButton.dataset.state) {
                    showButton.dataset.state = 'on';
                    container.dataset.state = 'on';
                } else {
                    showButton.dataset.state = 'off';
                    container.dataset.state = 'off';
                    setTimeout(endScroll, 500);

                }
            };

            var scrollTimer = null;
            var acScrolling = false;
            var acScrollTop = $(window).scrollTop();

            $(window).scroll(function () {

                if (ACT.settings.acScrolling === false) {
                    setTimeout(function(){ACT.ac_fn.startScroll(showButton);}, 200);
                }
                
                if (scrollTimer) {
                    clearTimeout(scrollTimer);   // clear any previous pending timer
                }

                scrollTimer = setTimeout(function(){ACT.ac_fn.endScroll(showButton);}, 200);   // set new timer

            });

            function startScroll() {


            }

            function endScroll() {

            }

        }
    },
    ac_fn: {
        open : function (container, showButton ) {
            showButton.onclick = function () {
                //console.log('clicker');

                if ('off' === showButton.dataset.state) {
                    showButton.dataset.state = 'on';
                    container.dataset.state = 'on';
                } else {
                    showButton.dataset.state = 'off';
                    container.dataset.state = 'off';
                }
            };
        },
        startScroll: function(showButton){

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
            ACT.settings.acScrolling = true;
        },
        endScroll: function(showButton){
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
    settings : {
        acScrolling : false
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


