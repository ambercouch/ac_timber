<?php

function act_nav_menu_walker( $args ) {
    return array_merge( $args, array(
        'walker' => new Ac_Walker_Nav_Menu(),
        'menu_class' => 'nav-menu__list',
        'container_class' => 'nav-menu'
    ) );
}
add_filter( 'wp_nav_menu_args', 'act_nav_menu_walker' );
