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
            'before_widget' => '<aside id="%1$s" class="l-widget-area__widget--'.$sidebar_slug.'-widgets %2$s"><div  class="widget c-widget--'.$sidebar_slug.'">',
            'after_widget' => '</div></aside>',
            'before_title' => '<div class="c-widget__header--'.$sidebar_slug  . '" ><header class="c-header--'.$sidebar_slug  . '" ><h3 class="c-header__heading--'.$sidebar_slug  . '" ><span class="c-header__title">',
            'after_title' => '</span></h3></header></div>'
        ));
    }
}
add_action('widgets_init', '_act_widgets_init');
