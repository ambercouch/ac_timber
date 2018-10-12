<?php

function act_nav_menu_walker( $args ) {

    $menu_slug = $args['menu']->slug;
    $menu_slug = ($menu_slug == '') ? $args['menu'] : $menu_slug;

    $menu_class_mod = '--' . $menu_slug;

    return array_merge( $args, array(
        'walker' => new Ac_Walker_Nav_Menu(),
        'menu_class' => 'c-nav-menu__list'.$menu_class_mod,
        'container_class' => 'c-nav-menu'.$menu_class_mod
    ) );
}
add_filter( 'wp_nav_menu_args', 'act_nav_menu_walker' );
