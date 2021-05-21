/**
 * Created by Richard on 19/09/2016.
 */

console.log('ACTIMBER SEARCH');
ACTIMBER = {
    common: {
        init: function () {
            'use strict';
            //uncomment to debug
            console.log('common');

            //add js class
            jQuery('body').addClass('js');

            //$("[data-fitvid]").fitVids();

            $('[data-control]').each(function () {
                var controlId = $(this).attr('data-control')
                if (controlId != ''){
                    var showButton = $('[data-control='+controlId+']');
                    var container = $('[data-container='+controlId+']');
                    ACTIMBER.fn.open(container, showButton);
                }

            })


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
        open: function (container, showButton, parent, listParent) {
            var elState = showButton.attr('data-state');
            var eventActOpen = new Event('actOpen');
            var eventActClose = new Event('actClose');
            var containId = container.attr('data-container')
            showButton.on('click', function (e) {
                e.preventDefault();
                console.log('clicker');
                elState = showButton.attr('data-state');
                if ('off' === elState) {
                    showButton.attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('is-state-on');
                    document.body.className += ' container-is-open ' + 'container-open-' + containId ;
                    window.dispatchEvent(eventActOpen)

                } else {
                    console.log(document.body.className)
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
