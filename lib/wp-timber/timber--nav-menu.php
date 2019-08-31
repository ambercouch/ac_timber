<?php
function act_nav_menu_walker( $args ) {
    //Test the $args to get the slug
    $slug = '';
    if (is_object($args['menu'])){
        $slug = $args['menu']->slug;
    }
    elseif (is_string($args['menu'])){
        $slug = strtolower($args['menu']);
    }
    return array_merge( $args, array(
        'walker' => new Ac_Walker_Nav_Menu(),
        'menu_class' => 'c-nav-menu__list--'.$slug,
        'container_class' => 'c-nav-menu--'.$slug
    ) );
}
add_filter( 'wp_nav_menu_args', 'act_nav_menu_walker' );