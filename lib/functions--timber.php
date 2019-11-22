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
        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        add_image_size ( 'feature500', 500, 500, true );
        add_image_size ( 'feature16-9', 1600, 900, true );
        add_image_size ( 'feature16-4', 1600, 400, true );
        add_image_size ( 'serviceMenuLarge', 600, 900, true );
        add_image_size ( 'serviceMenuMedium', 400, 600, true );
        add_image_size ( 'serviceMenuSmall', 200, 300, true );


        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );

        add_filter('widget_text','do_shortcode');

        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );

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
        $context['environment'] = ENVIRONMENT;

        //AC Template settings
        $context['acSettings'] = acSettings();

        //Set up Menus defined functions--ac-menus.php
        foreach (unserialize(ACT_MENUS) as $menu){
            //Menus
            if($menu == 'Primary'){
                //Alway make the primary menu will fallback to page menu
                $context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
            }elseif (is_nav_menu($menu)){
                //Only create the timber menus if they exist as we don't want fallback
                $context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
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

        //ACF page setup
        $context['hidePageTitle'] = get_field('hide_title', $post_id);
        $context['hidePageMasthead'] = get_field('hide_site_masthead', $post_id);

        //ACF options
        $context['typeKitId'] = (get_field('type_kit_id', 'options') == '') ? acSettings()['typeKitId'] : get_field('type_kit_id', 'options') ;

        //Remove the auto p from afc
        remove_filter ('acf_the_content', 'wpautop');

        $context['site_info'] = get_field('site_info', 'options');
        $context['company_logo'] = get_field('company_logo', 'options');

        //Add the auto p from afc
        add_filter ('acf_the_content', 'wpautop');


        $context['removeHero'] = get_field('remove_hero_banner', 'options');
        $context['hasHeroClass'] = (get_field('remove_hero_banner', 'options') || (! is_home() && ! is_front_page()) )? 'has-no-hero' : 'has-hero';
        $context['siteMastheadModClass'] = (get_field('overlay_hero_banner', 'options'))? '--overlay-hero' : '';

        $context['pageGlobalSettingHideComments'] = get_field('hide_page_comments','options');
        $context['pageSettingsShowComments'] = get_field('show_page_comments', $post_id);

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

        $context['beforeContentType'] = get_field('before_content_type', 'options');
        $context['beforeContentTitle'] = get_field('before_content_title', 'options');
        $context['beforeContentText'] = get_field('before_content_text', 'options');
        $context['beforeContentAdvanced'] = get_field('before_content_advanced', 'options');

//      $context['postComment'] = wp_list_comments(array( 'callback' => 'comment_layout' ), get_comments($post_id));
        return $context;

    }

    function add_to_twig( $twig ) {
        /* this is where you can add your own fuctions to twig */
        $twig->addExtension( new Twig_Extension_StringLoader() );
        $twig->addFilter( 'ac_dd', new Twig_Filter_Function( 'ac_dd' ) );
        return $twig;
    }

}

new StarterSite();

function ac_dd($var){
    echo '<pre>', print_r($var, true), '</pre>';
    die();
}

function myfoo( $text ) {
    $text .= ' bar!';
    return $text;
}

require_once get_template_directory() . '/lib/wp-timber/timber--nav-menu.php';

