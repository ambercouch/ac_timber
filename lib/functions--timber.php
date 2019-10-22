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

        remove_filter ('acf_the_content', 'wpautop');
        $context['site_info'] = get_field('site_info', 'options');

        $context['company_logo'] = get_field('company_logo', 'options');

        //site vars
        $context['site'] = $this;

        //Template settings
        $context['acSettings'] = acSettings();

        //Set up Menus defined functions--ac-menus.php
        foreach (unserialize(ACT_MENUS) as $menu){
            //Menus
            if($menu == 'Primary'){
                //Alway make the primary menu will fallback to page menu
                $context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
            }elseif (has_nav_menu( strtolower($menu) )){
                //Only create the timber menus if they exist as we don't want fallback
                $context['menu'.ucfirst($menu)] = new TimberMenu(strtolower($menu));
            }else{
                //$context['menu'.ucfirst($menu)] = 'no menu - '.strtolower($menu);
            }
        }

        //Primary Menu
        $context['menuPrimary'] = new TimberMenu('primary');

       // $context['menuTest'] = new TimberMenu('menutest');

        //$context['menuHero'] = new TimberMenu('hero');

        $context['bannerImage'] = get_field('banner_image', 'options');

        foreach( unserialize(SIDEBARS) as $sidebar ) {
            $context[strtolower($sidebar).'_widgets'] = Timber::get_widgets($sidebar);
        }

//        $context['primary_widgets'] = Timber::get_widgets('Primary');
//        $context['subsidiary_widgets'] = Timber::get_widgets('Subsidiary');

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


