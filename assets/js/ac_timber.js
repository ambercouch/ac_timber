/**
 * Created by Richard on 19/09/2016.
 */

console.log('ACTIMBER ISOTOPE 123');
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

            $('[data-modal-trigger]').each(function (i) {
                let triggerId = $(this).attr('data-modal-trigger');

                $('[data-modal-trigger='+triggerId+']').modaal({
                    content_source: '[data-modal='+triggerId+']'
                });
            })


            // $('[data-modal]').modaal('open');

            $('[data-modal-close]').on('click', function () {
                $('[data-modal]').modaal('close');
            })



            let elem = document.querySelector('[data-flickity=project-slider]');
            if(elem){

                let flkty = new Flickity( elem, {
                    // options
                    cellAlign: 'left',
                    contain: true,
                    pageDots: false
                });

            }


            var $grid
            $grid = $('.l-post-thumb-list__list--blog').isotope({
                itemSelector: '.l-post-thumb-list__item--blog',
                percentPosition: true,
                layoutMode: 'packery',
                packery: {
                    gutter: 48
                }
            });

// element argument can be a selector string
//   for an individual element


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
