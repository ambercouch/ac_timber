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
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
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

        //AC Template settings
        $context['acSettings'] = acSettings();

        //Primary Menu
        $context['menuPrimary'] = new TimberMenu('primary');

        //Hero Menu
        $context['menuHero'] = new TimberMenu('hero');

        //Set up sidebars defined functions--ac-sidebars.php
        foreach( unserialize(SIDEBARS) as $sidebar ) {
            $context[strtolower($sidebar).'_widgets'] = Timber::get_widgets($sidebar);
        }

        /*
         * ACF Settings Setup
         */

        //ACF page setup
        $context['hidePageTitle'] = get_field('hide_title', $post_id);
        $context['hidePageMasthead'] = get_field('hide_site_masthead', $post_id);

        //ACF options
        //Remove the auto p from afc
        remove_filter ('acf_the_content', 'wpautop');

        $context['site_info'] = get_field('site_info', 'options');

        $context['company_logo'] = get_field('company_logo', 'options');

        //Add the auto p from afc
        add_filter ('acf_the_content', 'wpautop');

        $context['hideBannerMenu'] = get_field('hide_banner_menu', 'options');

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


