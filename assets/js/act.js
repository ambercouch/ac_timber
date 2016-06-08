/**
 * Created by Richard on 12/05/2016.
 */


ACT = {
    common: {
        init: function () {

            'use strict';
            console.log('common');

            console.log('actjs');


            // $('.fitvid').fitVids();

            // if ( ! Modernizr.objectfit ) {
            //     $('div[class^="feature-image"]').each(function () {
            //         var $container = $(this),
            //             imgUrl = $container.find('img').prop('src');
            //         if (imgUrl) {
            //             $container
            //                 .css('backgroundImage', 'url(' + imgUrl + ')')
            //                 .addClass('compat-object-fit');
            //         }
            //     });
            // }

            var showButton = document.getElementById('menuButton');
            var container = document.getElementById('primaryNavigation');
            ACT.ac_fn.open(container, showButton);
            //
            // var searchButton = document.getElementById('mastheadSearchBtn');
            // var searchForm = document.getElementById('mastheadSearchForm');
            // ACT.ac_fn.open(searchForm, searchButton);


            // var ddMenus = document.getElementsByClassName('menu-item-has-children');
            // var ddList;
            // var itemid;
            //
            // [].forEach.call(ddMenus, function (e, i) {
            //     itemid = e.dataset.itemid;
            //     ddList = e.parentNode;
            //     var ddparent = document.getElementById('itemId' + itemid);
            //     var ddButton = document.getElementById('linkId' + itemid);
            //     var subMenu = document.getElementById('listId' + itemid);
            //     ACT.ac_fn.open(subMenu, ddButton, ddparent, ddList);
            // });

            var drawers = document.getElementsByClassName('drawer');
            var drawerButton = 'drawer__title';
            var drawerContent = 'drawer__content';
            ACT.ac_fn.open_collection( drawers, drawerButton, drawerContent);

        }
    },
    page: {
        init: function () {
            //uncomment to debug
            console.log('pages');
        },
        bathroom_inspiration: function () {
            ACT.ac_fn.gallery();
        }
    },
    home: {
        init: function () {
            //uncomment to debug
            //console.log('posts');
        }
    },
    archive: {
        init:function () {

        },
        tile : function () {
            console.log('tile');
            var grid = '.content--archive-tile';
            var item = '.tile';
            ACT.ac_fn.isotope(grid, item);
        },
        our_work : function () {
            console.log('our_work   ');
            var grid = '.content--archive-our-work';
            var item = '.our-work';
            ACT.ac_fn.isotope(grid, item);
        }
    },
    our_work: {
        init: function () {
            console.log('our work');
            ACT.ac_fn.gallery();
        },
    },
    ac_fn: {
        open: function (container, showButton, parent, listParent) {
            var elState = $(showButton).attr('data-state');
            showButton.onclick = function () {
                console.log('clicker');
                elState = $(showButton).attr('data-state');
                if ('off' === elState) {
                    $(showButton).attr('data-state', 'on');
                    $(container).attr('data-state', 'on');
                    $(parent).attr('data-state', 'on');
                    $(container).addClass('ac-on');

                } else {
                    $(showButton).attr('data-state', 'off');
                    $(container).attr('data-state', 'off');
                    $(parent).attr('data-state', 'off');
                    $(container).removeClass('ac-on');
                }
            };
        },
        open_collection: function (collection, buttonClass, containerClass) {

            [].forEach.call(collection, function (e, i) {
                var buttons, containers, button, container;
                buttons = e.getElementsByClassName(buttonClass);
                containers = e.getElementsByClassName(containerClass);

                //console.log(mapButtons);
                if (buttons[0]) {
                    button = buttons[0];
                    container = containers[0];
                    ACT.ac_fn.open(container, button);
                }
            });

        },
        startScroll: function (showButton) {
            ACT.settings.acScrolling = true;
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

        },
        endScroll: function (showButton) {
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
        },
        gallery: function () {

            $('.gallery__slides').flickity({
                initialIndex: 0,
                contain: true,
                imagesLoaded: true,
                cellAlign: 'center'
            });

            $('.gallery__controller').flickity({
                asNavFor: '.gallery__slides',
                contain: true,
                setGallerySize: false,
                pageDots: false
            });

            var slides =  $('.gallery__slide').clone();
            var controls = $('.gallery__thumb').clone();
            $(document).on('click', '.filter-controls__tag', function (e) {
                var fState =  $(this).attr('data-state');
                var fType =  $(this).attr('data-type');
                var activeFillters = $(this).parent().find('[data-state=on]').length;
                var el = $('[data-type='+fType+']');
                console.log('AF'+activeFillters);
                if('on' === fState && activeFillters > 1){
                    $(this).attr('data-state', 'off');
                    $('.gallery__slides').flickity('remove', el);
                  $('.gallery__controller').flickity('remove', el);
                    console.log(slides);
                }else if('off' === fState){
                    $(this).attr('data-state', 'on');
                    $(slides).each(function (i,e) {
                        var eType = $(e).attr('data-type')

                        var cell = $(e);
                        if(eType == fType) {
                            $('.gallery__slides').flickity('append', cell);
                        }
                    });
                    $(controls).each(function (i,e) {
                        var eType = $(e).attr('data-type')

                        var cell = $(e);
                        if(eType == fType) {
                            $('.gallery__controller').flickity('append', cell);
                        }
                    });


                    // $('.gallery__controller').flickity('append', $(controls).find('[data-type='+fType+']'));
                    console.log(slides);
                }

            });

        },
        isotope : function (grid, item) {
            // console.log('tile archive');
            var $grid = $(grid).isotope({
                itemSelector: item,
                percentPosition: true,
                masonry: {
                    columnWidth: item
                }
            });

            var filters = {};

            function concatValues( obj ) {
                var value = '';
                for ( var prop in obj ) {

                    value += obj[ prop ];
                }
                return value;
            }

            $(document).on('click' , '.filter-controls__tag', function(){
                var $this =  $(this)
                var $parent = $this.parent();
                var tax = $parent.attr('data-tax');
                var filter = $this.not('[data-state=on]').attr('data-filter') != undefined ? '.'+$this.attr('data-filter') : '';
                var filterVal;

                filters[tax] = filter;

                filterVal = concatValues(filters);

                console.log(filters);
                console.log(filterVal);
                $grid.isotope({ filter: filterVal });

                $parent.find('[data-state=on]').not(this).attr('data-state', 'off');
                $(this).attr('data-state', function (i, attr) {
                    return attr === 'on' ? 'off' : 'on';
                })
            });
        }
    },
    settings: {
        acScrolling: false
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


