/**
 * Created by Richard on 19/09/2016.
 */

console.log('ACTIMBER CF7 redirect');
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

            document.addEventListener( 'wpcf7mailsent', function( event, el ) {

                var cf7Id = event.detail.id;
                var selectorRedirect = '#'+cf7Id+' input[name=redirect]';
                var redirect = $(selectorRedirect).val();
                if(redirect){
                    location = redirect;
                }

                console.log(selectorRedirect);
                console.log($(selectorRedirect).val());
                console.log('event detail id');
                console.log('el');
                console.log(el);

            }, false );

            var act_new_visitor = (Cookies.get('_act-return') === 'is-return' ) ? false : true;
            var hide_popup = (Cookies.get('_act-hide-popup') === 'is-hidden') ? true : false

            var notice = $('[data-remodal-id=notice-covid]').remodal();

            console.log('hide_popup test ')
            console.log(hide_popup)
            if (hide_popup === false){
                console.log('hide_popup')
                console.log(hide_popup)
                notice.open();
            }

            $(document).on('cancellation', '[data-remodal-id=notice-covid]', function () {
                console.log('Cancel button is clicked');
                    Cookies.set('_act-hide-popup', 'is-hidden');
            });

            console.log('$act_new_vistitor');
            console.log(act_new_visitor);

            Cookies.set('_act-return', 'is-return');





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
