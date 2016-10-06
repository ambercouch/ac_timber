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
            ACT.ac_fn.gallery();
        },
        bathroom_inspiration: function () {
            // ACT.ac_fn.gallery();
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
            var grid = '.content--archive-tile:not(.is-empty)';
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
            var arrayFilters = {};
            $.each(slides, function (i,el) {
                var filter = $(el).attr('data-type');
                arrayFilters[filter] = false;
            });

            console.log(arrayFilters);
            $(document).on('click', '.filter-controls__tag', function (e) {
                var fState =  $(this).attr('data-state');
                var fType =  $(this).attr('data-type');
                var activeFillters = $(this).parent().find('[data-state=on]').length;
                var el = $('[data-type='+fType+']');


                if('on' === fState){
                    $(this).attr('data-state', 'off');
                    arrayFilters[fType] = false;
                    appendEls();
                }else if('off' === fState){
                    $(this).attr('data-state', 'on');
                    arrayFilters[fType] = true;
                    appendEls();

                }

            });

            function appendEls() {
                var allFalse = $.inArray(true, $.map(arrayFilters, function(obj){return obj})) < 0;
                
                if (allFalse){
                    console.log('allFalse');
                    $.each(arrayFilters, function (i) {
                        arrayFilters[i] = true;
                    });
                }
                
                
                $.each(arrayFilters, function (i) {
                    //console.log(i);
                    var filter = i;
                    var elLength = $('.gallery__slides [data-type='+filter+']').length
                    if(arrayFilters[i] == true && elLength == 0){
                        console.log('true');
                        console.log(filter);
                        // $('.gallery__slides').flickity('remove', $('[data-type='+filter+']'));
                        // $('.gallery__controller').flickity('remove', $('[data-type='+filter+']'));
                        console.log('slides');
                        $.each(slides , function (i,el) {
                            console.log(el);
                            if($(el).attr('data-type') == filter){
                                console.log('True');
                                console.log('DT - ' + $(el).attr('data-type'));
                                console.log('FT - ' + filter );
                                $('.gallery__slides').flickity('append', el);
                            }else {
                                console.log('False');
                                console.log('DT - ' + $(el).attr('data-type'));
                                console.log('FT - ' + filter );
                            }
                        });
                        console.log('controls');
                        $.each(controls , function (i,el) {
                            console.log(el);
                            if($(el).attr('data-type') == filter){
                          $('.gallery__controller').flickity('append', el);
                            }
                        })
                    }else if(arrayFilters[i] == false){
                        console.log('false');
                        console.log(filter);
                        $('.gallery__slides').flickity('remove', $('[data-type='+filter+']'));
                        $('.gallery__controller').flickity('remove', $('[data-type='+filter+']'));
                    }
                })

                if (allFalse){
                    console.log('allFalse');
                    $.each(arrayFilters, function (i) {
                        arrayFilters[i] = false;
                    });
                }
            }

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

            function getHashFilter() {
                // get filter=filterName
                var matches = location.hash.match( /filter=([^&]+)/i );
                var hashFilter = matches && matches[1];
                return hashFilter && decodeURIComponent( hashFilter );
            }

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

                location.hash = 'filter=' + encodeURIComponent( filterVal );


                $parent.find('[data-state=on]').not(this).attr('data-state', 'off');
                $(this).attr('data-state', function (i, attr) {
                    return attr === 'on' ? 'off' : 'on';
                })
            });

            var isIsotopeInit = false;

            function onHashchange() {
                var hashFilter = getHashFilter();

                if ( !hashFilter ) {
                    console.log('!hashFilter');
                    $grid.isotope({ filter: getHashFilter() });
                    return;
                }
                $('#isoFilters > [data-state=off]').attr('data-state', 'on');
                var arrayHashFilter = hashFilter.split('.');

                //Clean Array
                arrayHashFilter = arrayHashFilter.filter(Boolean);

                isIsotopeInit = true;
                $grid.isotope({ filter: getHashFilter() });

                $('.filter-controls__tags [data-state=on]').attr('data-state', 'off');
                $.each(arrayHashFilter, function (i) {
                    var $filter = $('.filter-controls__tags [data-filter='+arrayHashFilter[i]+']')
                    $filter.attr('data-state', 'on');
                    var $parent = $filter.parent();
                    var tax = $parent.attr('data-tax');

                    filters[tax] = '.'+arrayHashFilter[i];
                });
            }

            $(window).on( 'hashchange', onHashchange );

            // trigger event handler to init Isotope
            onHashchange();


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


