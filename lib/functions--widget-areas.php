<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _act_widgets_init() {
    foreach( unserialize(ACT_SIDEBARS) as $sidebar ) {
        $sidebar_slug = str_replace(' ', '-', strtolower($sidebar));
        register_sidebar(array(
            'name' => __($sidebar , '_act'),
            'id' => 'aside-'.$sidebar_slug,
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="'.$sidebar_slug.'-widgets__widget %2$s"><div  class="widget widget--'.$sidebar_slug.'">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h3 class="widget__title--'.strtolower($sidebar). '" >',
            'after_title' => '</h3>'
        ));
    }
}
add_action('widgets_init', '_act_widgets_init');