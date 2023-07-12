<?php

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _act_widgets_init() {
    foreach( unserialize(SIDEBARS) as $sidebar ) {
        $sidebar_slug = str_replace(' ', '-', strtolower($sidebar));
        register_sidebar(array(
            'name' => __($sidebar , '_s'),
            'id' => 'aside-'.$sidebar_slug,
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget '.$sidebar_slug.'__widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget__title">',
            'after_title' => '</h3>',
        ));
      }

}

add_action('widgets_init', '_act_widgets_init');

