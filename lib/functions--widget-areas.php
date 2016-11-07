<?php
/**
 * Register widget area.
 *
 * To add a new sidebar edit functions--ac-settings
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _act_widgets_init() {
    foreach( unserialize(SIDEBARS) as $sidebar ) {
        register_sidebar(array(
            'name' => __($sidebar , '_act'),
            'id' => 'aside-'.strtolower($sidebar),
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="'.strtolower($sidebar).'__widget %2$s"><div  class="widget widget--'.strtolower($sidebar).'">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h3 class="widget--'.strtolower($sidebar).'__title">',
            'after_title' => '</h3>'
        ));
    }

}

add_action('widgets_init', '_act_widgets_init');