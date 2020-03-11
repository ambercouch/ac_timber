/**
 * Created by Richard on 19/09/2016.
 */

console.log('ACTIMBER data state');
ACTIMBER = {
    common: {
        init: function () {
            'use strict';
            //uncomment to debug
            console.log('common');

            //add js class
            jQuery('body').addClass('js');

            //$("[data-fitvid]").fitVids();

            var $first_renewal  = $(".first-payment-date small");
            var $first_renewal_text = $first_renewal.text();
            $first_renewal.text($first_renewal_text.replace('First renewal', 'Next payment date'))

            $('[data-control]').each(function() {

                const containerId = $(this).attr('data-control');

                const controlSelector = (containerId != '' )? '[data-control='+ containerId + ']' : this;

                const control = $(this);

                const controlGroupId = control.first().attr('data-state-group');

                const containerSelector = (containerId != '' )? '[data-container='+ containerId + ']' : '[data-container]';

                const container = $(containerSelector);

                control.off('click');

                control.on('click',  function (e) {
                    console.log('clickered');
                    const state = control.attr('data-state');
                    e.preventDefault();


                    if (controlGroupId){
                        console.log('clickered group');
                        if (state == 'off') {
                            ACTIMBER.fn.actStateToggleSelect(control, state);
                            ACTIMBER.fn.actStateToggleGroup(control, container, controlGroupId, state);
                            ACTIMBER.fn.actStateToggleSelect(container, state);
                            //ACTIMBER.fn.actStateToggleGroup(container, controlGroupId);
                        }

                    }else{
                        console.log('clickered not group');
                        // ACTIMBER.fn.actStateToggle(container, control);
                        ACTIMBER.fn.actStateToggleSelect(control, state);
                        ACTIMBER.fn.actStateToggleSelect(container, state);
                    }
                });

            });

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
        actStateToggleGroup : function (control, container, stateGroupId, state){
            console.log('group toggle');
            $('[data-state-group='+stateGroupId+']').not(control).not(container).attr('data-state', 'off')
            // $('[data-state-group='+stateGroupId+']').not(control).not(container).each(function(){
            //     if ('off' === $(this).attr('data-state') ) {
            //         $(this).attr('data-state', 'on');
            //     } else if ('on' === $(this).attr('data-state') ) {
            //         $(this).attr('data-state', 'off');
            //     } else{
            //         console.log('compfail');
            //         console.log($(this).attr('data-state'));
            //     }
            // })

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
                console.log('elState');
                console.log(this);

                console.log(elState);

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
        actStateClose: function (container, showButton, closeButton) {
            var elState = closeButton.attr('data-state');

            var eventActClose = new Event('actClose');

            // var eventActOpen = document.createEvent('Event');
            // eventActOpen.initEvent('actOpen', true, true);
            // var eventActClose = document.createEvent('Event');
            // eventActClose.initEvent('actClose', true, true);


            closeButton.on('click', function(e){
                e.preventDefault();
                elState = $(this).attr('data-state');

                console.log('click off');
                showButton.attr('data-state', 'off');
                closeButton.attr('data-state', 'off');
                $(container).attr('data-state', 'off');
                $(container).removeClass('ac-on');
                document.querySelector('body').classList.remove('container-is-open');

                window.dispatchEvent(eventActClose);

            });
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
