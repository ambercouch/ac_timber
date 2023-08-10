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

        //site vars
        $context['site'] = $this;

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
        foreach( unserialize(SIDEBARS) as $sidebar ) {
            $context[strtolower(str_replace(' ','',$sidebar)).'_widgets'] = Timber::get_widgets('aside-' . strtolower(str_replace(' ','-',$sidebar) ));
        }


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

function ac_dd($var)
{
    $var = var_export($var, true);
    return '<pre>'. $var . '</pre>';
}

function myfoo( $text ) {
    $text .= ' bar!';
    return $text;
}


