/**
 * Created by Richard on 19/09/2016.
 */

//console.log('ACTIMBER');
ACTIMBER = {
    common: {
        init: function () {
            'use strict';
            //uncomment to debug
            console.log('common');
            console.log(window.innerHeight);

            var mhHeight = ACTIMBER.fn.actElDimensions('#masthead').height;
            ACTIMBER.fn.setMastheadDimension(mhHeight);
            ACTIMBER.fn.cssEl();

            //add js class
            jQuery('body').addClass('js');

            $("[data-fitvid]").fitVids();

            
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
        actElDimensions: function (selector) {
            if (selector == undefined){
                selector = 'html'
            }

            return {
                width : $(selector).outerWidth(),
                height : $(selector).outerHeight(),
            }
        },
        setMastheadDimension: function (height, width) {

            if (height){
                ACTIMBER.settings.actMasthead.height = height;
            }
            if (width){
                ACTIMBER.settings.actMasthead.height = width;
            }
        },
        cssEl : function (selector, css) {

            if(selector == undefined){
                selector = '.hero'
            }
            if(css == undefined){
                css = {
                    'position' : 'relative',
                    'top' : ACTIMBER.settings.actMasthead.height,
                    'height' : window.innerHeight - ACTIMBER.settings.actMasthead.height
                }
            }
            $(selector).css(css);
        }
    },
    settings: {
        actScrolling: false,
        actMasthead:{
            'height' : false
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