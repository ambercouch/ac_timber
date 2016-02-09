ACT = {
    common: {
        init: function () {
            'use strict';
            console.log('common');

            $('.fitvid').fitVids();

            var showButton, container, searchButton, searchForm;

            showButton = document.getElementById('menuButton');
            container = document.getElementById('primaryNavigation');

            showButton.onclick = function () {
                if ('off' === showButton.dataset.state) {
                    showButton.dataset.state = 'on';
                    container.dataset.state = 'on';
                } else {
                    showButton.dataset.state = 'off';
                    container.dataset.state = 'off';
                }
            };

            searchButton = document.getElementById('mastheadSearchBtn');
            searchForm = document.getElementById('mastheadSearchForm');

            searchButton.onclick = function(){
                console.log('click');
                if ('off' === searchButton.dataset.state) {
                    searchButton.dataset.state = 'on';
                    searchForm.dataset.state = 'on';
                } else {
                    searchButton.dataset.state = 'off';
                    searchForm.dataset.state = 'off';
                }

            };
        }
    },
    page: {
        init: function () {
            //uncomment to debug
            //console.log('pages');
        },
        events: function(){
            console.log('events');
            var maps,map, mapButtons,mapButton, events;
            events = document.getElementsByClassName('event');

            console.log(events);
            //console.log(mapButtons);

            [].forEach.call(events, function(e,i) {
                mapButtons = e.getElementsByClassName('btn--toggle-map');
                maps = e.getElementsByClassName('event__map-container');

                console.log(mapButtons);
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

            //searchButton.onclick = function(){
            //    console.log('click');
            //    if ('off' === searchButton.dataset.state) {
            //        searchButton.dataset.state = 'on';
            //        searchForm.dataset.state = 'on';
            //    } else {
            //        searchButton.dataset.state = 'off';
            //        searchForm.dataset.state = 'off';
            //    }
            //
            //};

        }
    },
    post: {
        init: function () {
            //uncomment to debug
            //console.log('posts');
        },
        blog : function () {

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

                if (acScrolling === false) {
                    setTimeout(startScroll, 200);
                }
                if (scrollTimer) {
                    clearTimeout(scrollTimer);   // clear any previous pending timer
                }

                scrollTimer = setTimeout(endScroll, 200);   // set new timer

            });

            function startScroll() {

                acScrollTop = $(window).scrollTop();

                if ($('#act_masthead').data('hidden') === true && acScrollTop >= 100) {
                    $('#act_masthead').data('hidden', false);
                    $('#act_masthead').attr('data-hidden', false);
                }
                if ($('#act_masthead').data('hidden') === false && acScrollTop <= 100 && showButton.dataset.state === 'off') {
                    $('#act_masthead').data('hidden', true);
                    $('#act_masthead').attr('data-hidden', true);
                }
                acScrolling = true;
            }

            function endScroll() {
                acScrolling = false;
                acScrollTop = $(window).scrollTop();

                if ($('#act_masthead').data('hidden') === true && acScrollTop >= 100) {
                    $('#act_masthead').data('hidden', false);
                    $('#act_masthead').attr('data-hidden', false);
                }
                if ($('#act_masthead').data('hidden') === false && acScrollTop <= 100 && showButton.dataset.state === 'off') {
                    $('#act_masthead').data('hidden', true);
                    $('#act_masthead').attr('data-hidden', true);
                }
            }

        }
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


