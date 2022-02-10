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

            //add js class
            jQuery('body').addClass('js');
            //$("[data-fitvid]").fitVids();

            fitvids();

            if(typeof acf !== 'undefined'){
                if( acf.fields.color_picker ) {
                    // custom colors
                    var palette = ['#111111', '#333333', '#555555', '#777777', '#999999', '#cccccc'];

                    // when initially loaded find existing colorpickers and set the palette
                    acf.add_action('load', function() {
                        $('input.wp-color-picker').each(function() {
                            $(this).iris('option', 'palettes', palette);
                        });
                    });

                    // if appended element only modify the new element's palette
                    acf.add_action('append', function(el) {
                        $(el).find('input.wp-color-picker').iris('option', 'palettes', palette);
                    });
                }
            }


            $(document).on('click', '[data-load-more]', function () {

                console.log('clicker')

                var button = $(this),
                    container_selector = '.l-post-thumb-list__list--blog',
                    data = {
                        'action': 'loadmore',
                        'query': ac_timber_params.posts, // that's how we get params from wp_localize_script() function
                        'page' : ac_timber_params.current_page
                    };

                container_selector = button.attr('data-container-selector') ?  button.attr('data-container-selector') : container_selector;

                $.ajax({ // you can also use $.post here
                    url : ac_timber_params.ajaxurl, // AJAX handler
                    data : data,
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.addClass('is-loading')
                    },
                    success : function( data ){
                        if( data ) {

                            $(container_selector).append(data);
                            button.removeClass('is-loading')
                            ac_timber_params.current_page++;

                            if (ac_timber_params.current_page == ac_timber_params.max_page )
                                button.remove(); // if last page, remove the button

                            // you can also fire the "post-load" event here if you use a plugin that requires it
                            // $( document.body ).trigger( 'post-load' );

                        } else {
                            button.remove(); // if no data, remove the button as well

                        }
                    }
                });

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
