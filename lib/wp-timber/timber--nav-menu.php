<?php

function act_nav_menu_walker( $args ) {


    return array_merge( $args, array(
        'walker' => new Ac_Walker_Nav_Menu(),
        'menu_class' => 'c-nav-menu__list--'.$args['menu']->slug,
        'container_class' => 'c-nav-menu--'.$args['menu']->slug
    ) );
}
add_filter( 'wp_nav_menu_args', 'act_nav_menu_walker' );
