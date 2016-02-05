ACT = {
    common: {
        init: function () {
            'use strict';
            console.log('common');

            $('.fitvid').fitVids();

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
                }
            };

            $(document).on('click', '.btn--search' , function(){
                console.log('click');
               if( $(this).attr('data-state','on').length){
                   $(this).attr('data-state','off');
               }else{
               $(this).attr('data-state','off');
               }

            });
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


