<?php

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
    return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

    function __construct() {
        add_theme_support( 'post-formats', array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat'
        ));
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        // woocommerce set up
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );



        add_image_size ( 'feature500', 500, 500, true );
        add_image_size ( 'feature16-9', 1600, 900, true );
        add_image_size ( 'feature16-4', 1600, 400, true );
        add_image_size ( 'serviceMenuLarge', 900, 600, true );
        add_image_size ( 'serviceMenuMedium', 600, 400, true );
        add_image_size ( 'serviceMenuSmall', 300, 200, true );


        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );

        add_filter('widget_text','do_shortcode');

        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );

        add_filter('excerpt_more', array( $this,'act_excertp_more')); // Add 'View Article' button instead of [...] for Excerpts


        add_action( 'wp_footer',  array( $this, 'act_add_footer_styles' )  );


        // Register all the menu locations.
        foreach (unserialize(ACT_MENUS) as $menu)
        {
            register_nav_menus(array(
                strtolower($menu) => esc_html__(ucfirst($menu), '_act'),
            ));
        }

        parent::__construct();
    }

    function register_post_types() {
        //this is where you can register custom post types
    }

    function register_taxonomies() {
        //this is where you can register custom taxonomies
    }

    function add_to_context( $context ) {

        //Site vars
        $context['site'] = $this;

        //Check if the ENVIRONMENT constant is defined
        if(defined('ENVIRONMENT')){
            $context['environment'] = ENVIRONMENT;
        }else{
            $context['environment'] = 'production';
        }

        //AC Template settings
        $context['acSettings'] = acSettings();

        //Set up Menus defined functions--ac-menus.php
        foreach (unserialize(ACT_MENUS) as $menu){
            //Menus
            // Hack to remove default primary menu
            if($menu == 'Primary.removedefault'){
                //Alway make the primary menu will fallback to page menu
                //$context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
            }elseif (has_nav_menu( strtolower($menu) )){
                //Only create the timber menus if they exist as we don't want fallback
                $context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
            }else{
                //$context['menu'.ucfirst($menu)] = 'no menu - '.strtolower($menu);
            }
        }

        //Set up sidebars defined functions--ac-sidebars.php
        foreach( unserialize(ACT_SIDEBARS) as $sidebar ) {
            $context[strtolower(str_replace(' ','',$sidebar)).'_widgets'] = Timber::get_widgets('aside-' . strtolower(str_replace(' ','-',$sidebar) ));
        }

        /*
         * ACF Settings Setup
         */
        global $post_id;

        //var_dump( get_field('page_banner_image')); die();

        $context['act_brand_colour']['theme'][1] = get_field('act_brand_colour_1', 'option');
        $context['act_brand_colour']['theme'][2] = get_field('act_brand_colour_2', 'option');
        $context['act_brand_colour']['theme'][3] = get_field('act_brand_colour_3', 'option');
        $context['act_brand_colour']['theme'][4] = get_field('act_brand_colour_4', 'option');
        $context['act_brand_colour']['theme'][5] = get_field('act_brand_colour_5', 'option');
        $context['act_brand_colour']['theme'][6] = get_field('act_brand_colour_6', 'option');
        $context['act_brand_colour']['theme'][7] = get_field('act_brand_colour_7', 'option');
        $context['act_brand_colour']['theme'][8] = get_field('act_brand_colour_8', 'option');
        $context['act_brand_colour']['theme'][9] = get_field('act_brand_colour_9', 'option');
        $context['act_brand_colour']['default']['1'] = acSettings()['brandColour']['1'];
        $context['act_brand_colour']['default'][2] = acSettings()['brandColour']['2'];
        $context['act_brand_colour']['default'][3] = acSettings()['brandColour']['3'];
        $context['act_brand_colour']['default'][4] = acSettings()['brandColour']['4'];
        $context['act_brand_colour']['default'][5] = acSettings()['brandColour']['5'];
        $context['act_brand_colour']['default'][6] = acSettings()['brandColour']['6'];
        $context['act_brand_colour']['default'][7] = acSettings()['brandColour']['7'];
        $context['act_brand_colour']['default'][8] = acSettings()['brandColour']['8'];
        $context['act_brand_colour']['default'][9] = acSettings()['brandColour']['9'];

        // Get ACF theme color options
        $context['header_background'] = get_field('header_background', 'option');
        $context['header_text_colour'] = get_field('header_text_colour', 'option');
        $context['header_link_colour'] = get_field('header_link_colour', 'option');

        $context['body_background'] = get_field('body_background', 'option');
        $context['body_text_colour'] = get_field('body_text_colour', 'option');
        $context['body_header_colour'] = get_field('body_header_colour', 'option');
        $context['body_link_colour'] = get_field('body_link_colour', 'option');

        $context['footer_background'] = get_field('footer_background', 'option');
        $context['footer_text_colour'] = get_field('footer_text_colour', 'option');
        $context['footer_header_colour'] = get_field('footer_header_colour', 'option');
        $context['footer_link_colour'] = get_field('footer_link_colour', 'option');

        $context['footer_info_background'] = get_field('footer_info_background', 'option');
        $context['footer_info_text_colour'] = get_field('footer_info_text_colour', 'option');
        $context['footer_info_link_colour'] = get_field('footer_info_link_colour', 'option');

        $context['options'] = get_fields('options');
        //ACF page setup
        $context['hidePageTitle'] = get_field('hide_title', $post_id);
        $context['pageTitleCssClasses'] = get_field('page_title_css_classes', $post_id);
        $context['hidePageMasthead'] = get_field('hide_site_masthead', $post_id);
        $context['hidePageLogo'] = get_field('hide_site_logo', $post_id);
        $context['hideMainNavigation'] = get_field('hide_site_navigation', $post_id);

        //ACF options
        $context['typeKitId'] = (get_field('type_kit_id', 'options') == '') ? acSettings()['typeKitId'] : get_field('type_kit_id', 'options') ;

        //Remove the auto p from afc
        remove_filter ('acf_the_content', 'wpautop');

        $context['site_info'] = get_field('site_info', 'options');
        $context['company_logo'] = get_field('company_logo', 'options');

        //Add the auto p from afc
        add_filter ('acf_the_content', 'wpautop');

        $context['logoWidthDesktop'] = get_field('logo_width','options');
        $context['logoHeightDesktop'] = get_field('logo_height','options');

        $context['logoWidthMobile'] = get_field('logo_width_mobile','options');
        $context['logoHeightMobile'] = get_field('logo_height_mobile','options');

        $context['removeHero'] = get_field('remove_hero_banner', 'options');
        $context['removeHeroBlog'] = get_field('remove_hero_banner_blog', 'options');
        $context['hasHeroClass'] = (get_field('remove_hero_banner', 'options') || ( get_field('banner_image', 'options') != '' or get_field('banner_image_colour_cast', 'options') != '' ) )? 'has-hero' : 'has-no-hero';
        //$context['siteMastheadModClass'] = (get_field('overlay_hero_banner', 'options'))? '--overlay-hero' : '';
        if (get_field('page_force_show_masthead', $post_id)) {
            $context['siteMastheadOverlayClass'] = 'is-not-overlay-hero';
        } elseif (is_front_page()) {
            $context['siteMastheadOverlayClass'] = get_field('overlay_hero_banner', 'options') ? 'is-overlay-hero' : 'is-not-overlay-hero';
        } else {
            $overlayCondition = get_field('overlay_hero_banner', 'options') && (get_field('page_banner_image') || get_field('show_site_hero'));
            $context['siteMastheadOverlayClass'] = $overlayCondition ? 'is-overlay-hero' : 'is-not-overlay-hero';
        }
        $context['pageGlobalSettingHideComments'] = get_field('hide_page_comments','options');
        $context['pageSettingsShowComments'] = get_field('show_page_comments', $post_id);
        $context['pageSettingsShowSiteHero'] = get_field('show_site_hero', $post_id);
        $context['pageSettingsHideSiteHero'] = get_field('hide_site_hero', $post_id);

        $context['postEditUrl'] =  get_edit_post_link($post_id);

        $context['serviceMenuShowExcerpt'] = get_field('show_service_excerpt', 'options');

        $context['hideBannerMenu'] = get_field('hide_banner_menu', 'options');
        $context['bannerImg'] = (get_field('banner_image', 'options') == '') ?  acSettings()['bannerImg'] : get_field('banner_image', 'options');
        $context['bannerContent'] = get_field('banner_content', 'options');
        $context['bannerLogo'] = get_field('banner_logo', 'options');

        $context['cssBannerImageSaturation'] = get_field('banner_image_saturation', 'options');
        $context['cssBannerColourCast'] = get_field('banner_image_colour_cast', 'options');
        $context['cssBannerColourCastColour'] = get_field('banner_image_colour_cast_colour', 'options');
        $context['cssBannerColourCastOpacity'] = get_field('banner_image_colour_cast_opacity', 'options');
        $context['cssBannerColourCastMode'] = get_field('banner_image_colour_cast_mode', 'options');
        $context['cssBannerImageHeight'] = get_field('banner_image_height', 'options');
        $context['cssBannerImagePositionHorizontal'] = get_field('banner_image_position_horizontal', 'options');
        $context['pageBannerImg'] = get_field('page_banner_image');
        $context['pageBannerContent'] = get_field('page_banner_content');
        $context['pageBannerLogo'] = get_field('page_banner_logo');

        $context['cssPageBannerImageSaturation'] = get_field('page_banner_image_saturation');
        $context['cssPageBannerColourCast'] = get_field('page_banner_image_colour_cast');
        $context['cssPageBannerColourCastColour'] = get_field('page_banner_image_colour_cast_colour');
        $context['cssPageBannerColourCastOpacity'] = get_field('page_banner_image_colour_cast_opacity');
        $context['cssPageBannerColourCastMode'] = get_field('page_banner_image_colour_cast_mode');
        $context['cssPageBannerImageHeight'] = get_field('page_banner_image_height');
        $context['cssPageBannerImagePositionHorizontal'] = get_field('page_banner_image_position_horizontal');


//      $context['postComment'] = wp_list_comments(array( 'callback' => 'comment_layout' ), get_comments($post_id));

        /*
         * Banner content classes
         */

        $site_banner_width = get_field('banner_content_width','options');
        $site_banner_opacity = get_field('banner_content_background_opacity','options') / 100;
        $site_banner_style_class = 'is-' . get_field('banner_content_style','options') .'-background';
        $site_banner_h_position = get_field('banner_content_position_horizontal','options');
        $site_banner_v_position = get_field('banner_content_position_vertical','options');

        $context['classSiteBannerContentWidth'] = $site_banner_width;
        $context['classSiteBannerContentStyle'] = $site_banner_style_class;
        $context['cssSiteBannerContentOpacity'] =  $site_banner_opacity ;
        $context['classSiteBannerContentPosHoz'] = $site_banner_h_position ;
        $context['classSiteBannerContentPosVert'] = $site_banner_v_position ;

        return $context;

    }

    function add_to_twig( $twig ) {
        /* this is where you can add your own fuctions to twig */
        $twig->addExtension( new Twig_Extension_StringLoader() );
        $twig->addFilter(new \Twig\TwigFilter('ac_dd', 'ac_dd'));
        return $twig;
    }


// Custom View Article link to Post
    function act_excertp_more ($more)
    {
        global $post;
        return '... <a class="c-post-thumb__link-more" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
    }

    function act_add_footer_styles() {

            wp_register_style('act_styles', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css') );
            wp_enqueue_style('act_styles');

    }

}

new StarterSite();

function ac_dd($var){
    echo '<pre>', print_r($var, true), '</pre>';
    die();
}

function timber_set_product( $post )
    {
        global $product;

        if (is_woocommerce())
        {
            $product = wc_get_product($post->ID);
        }
    }

/*
 * AC Fix for woocommerce_upsell_display when using PHP 8.1
 * Fatal error: Uncaught TypeError: array_slice(): Argument #3 ($length) must be of type ?int, array given in /home/vagrant/code/etp/public/wp-content/plugins/woocommerce/includes/wc-template-functions.php on line 2120
 * Fix : cast $limit to (int)
 * https://stackoverflow.com/a/76481455/1640115
*/
function woocommerce_upsell_display( $limit = '-1', $columns = 4, $orderby = 'rand', $order = 'desc' ) {
    global $product;

    if ( ! $product ) {
        return;
    }

    // Handle the legacy filter which controlled posts per page etc.
    $args = apply_filters(
        'woocommerce_upsell_display_args',
        array(
            'posts_per_page' => $limit,
            'orderby'        => $orderby,
            'order'          => $order,
            'columns'        => $columns,
        )
    );
    wc_set_loop_prop( 'name', 'up-sells' );
    wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );

    $orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
    $order   = apply_filters( 'woocommerce_upsells_order', isset( $args['order'] ) ? $args['order'] : $order );
    $limit   = (int)apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );

    // Get visible upsells then sort them at random, then limit result set.
    $upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
    $upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

    wc_get_template(
        'single-product/up-sells.php',
        array(
            'upsells'        => $upsells,

            // Not used now, but used in previous version of up-sells.php.
            'posts_per_page' => $limit,
            'orderby'        => $orderby,
            'columns'        => $columns,
        )
    );
}

require_once get_template_directory() . '/lib/wp-timber/timber--nav-menu.php';

