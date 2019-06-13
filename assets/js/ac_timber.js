/**
 * Created by Richard on 19/09/2016.
 */

//console.log('ACTIMBER');
ACTIMBER = {
    common: {
        init: function () {
            'use strict';
            //uncomment to debug
            console.log('common 1234 6');

            //add js class
            jQuery('body').addClass('js');

           // $("[data-fitvid]").fitVids();

            var showButton = $('[data-control=requestForm]');
            var container = $('[data-container=requestForm]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testMay19]');
            var container = $('[data-container=testMay19]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testApril19]');
            var container = $('[data-container=testApril19]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testMarch19]');
            var container = $('[data-container=testMarch19]');
            ACTIMBER.fn.open(container, showButton);


            var showButton = $('[data-control=testFeb19]');
            var container = $('[data-container=testFeb19]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testJan19]');
            var container = $('[data-container=testJan19]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testDec18]');
            var container = $('[data-container=testDec18]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testNov18]');
            var container = $('[data-container=testNov18]');
            ACTIMBER.fn.open(container, showButton);

            var showButton = $('[data-control=testSept18]');
            var container = $('[data-container=testSept18]');
            ACTIMBER.fn.open(container, showButton);



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
    fn:{
        open: function (container, showButton, parent, listParent) {
            var elState = showButton.attr('data-state');
            var eventActOpen = new Event('actOpen');
            var eventActClose = new Event('actClose');
            console.log('container');
            console.log(container);
            showButton.on('click', function(e){
                e.preventDefault();
                console.log('clicker');
                elState = showButton.attr('data-state');
                if ('off' === elState ) {
                    showButton.attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('ac-on');
                    document.body.className += ' ' + 'container-is-open';
                    window.dispatchEvent(eventActOpen)

                } else {
                    console.log(document.body.className)
                    $(showButton).attr('data-state', 'off');
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
