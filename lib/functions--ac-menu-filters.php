<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 09/01/2018
 * Time: 16:11
 */

add_filter('wp_nav_menu_objects', 'act_menu_filters', 10, 2);

function act_menu_filters($sorted_menu_objects, $args) {

    $menu = wp_get_nav_menu_object($args->menu);

    $menu_style = get_field('menu_style', $menu);


    //Image menu
    foreach ($sorted_menu_objects as $menu_object) {
        $menu_object->classes[] = "c-nav-menu__item--image";
        $object_id = $menu_object->object_id;
        if($menu_style == 'image'){
            $image_el = '';
            $link_thum_el = '';
            $menu_image = get_field('service_background_image' , $object_id);
            $srcSet = wp_get_attachment_image_srcset($menu_image['id'], 'serviceMenuLarge');
            $src = wp_get_attachment_image_url($menu_image['id'], 'serviceMenuLarge');
            $sizes = wp_get_attachment_image_sizes($menu_image['id'], 'serviceMenuLarge');
            if($src){
                $image_el = '<img class="c-post-thumb__img" alt="'.$menu_object->title.'" src="'.$src.'" srcset="'.$srcSet.'" sizes="'.$sizes.'"/>';

                $link_thum_el .= '<div class="c-post-thumb--menu-item">';
                $link_thum_el .= '<div class="c-post-thumb__image">';
                $link_thum_el .= $image_el;
                $link_thum_el .= '</div>';
                $link_thum_el .= '<div class="c-post-thumb__overlay-wrapper">';
                $link_thum_el .= '<div class="c-post-thumb__content--menu-item">';
                $link_thum_el .= '<header class="c-post-thumb__header">';
                $link_thum_el .= '<h2 class="c-post-thumb__heading">';
                $link_thum_el .= '<span class="c-post-thumb__title">';
                $link_thum_el .= $menu_object->title;
                $link_thum_el .= '</span>';
                $link_thum_el .= '</h2>';
                $link_thum_el .= '</header>';
                $link_thum_el .= '<div class="c-post-thumb__body">';
                $link_thum_el .= '<div class="c-post-thumb__read-more">';
                $link_thum_el .= 'Find out more';
                $link_thum_el .= '</div>';
                $link_thum_el .= '</div>';
                $link_thum_el .= '</div>';
                $link_thum_el .= '</div>';
                $link_thum_el .= '</div>';

                $menu_object->title = $link_thum_el;
            }
        };
    }

    //jump Links
    foreach ($sorted_menu_objects as $menu_object) {

        if (substr($menu_object->description, 0, 1) === "#" && substr($menu_object->description, 0, 6) != "#icon-" ) {
            $menu_object->url = $menu_object->url . $menu_object->description;
        }
    }

    //icon menus
    foreach ($sorted_menu_objects as $menu_object) {


        $menu_label = $menu_object->title;

        $menu_item_icon = get_field('menu_icon', $menu_object);
        $menu_item_icon_pos = get_field('icon_position', $menu_object);


        $menu_item_icon_show_label = get_field('show_label', $menu_object);
        $item_class_label = "";
        $item_class_label_pos = "";
        $menu_item_icon_label = "";

        if ($menu_item_icon_show_label == true){
            $menu_item_icon_label =  $menu_label;
            $item_class_label = " has-label ";
            $item_class_label_pos = " is-icon-pos-".$menu_item_icon_pos;
            $menu_object->classes[] =  $item_class_label;
            $menu_object->classes[] =  $item_class_label_pos;

        }

        if ($menu_item_icon != ""){
            $icon_class_mod = str_replace("icon-","", $menu_item_icon);
            $menu_item_icon_id = "#".$menu_item_icon;

            $title_markup = false;


            if ($menu_item_icon_label != ""){
                $title_markup = '<div class="c-nav-menu__icon-title">'.$menu_item_icon_label.'</div>';
            }

            $menu_object->title = '<div class="c-nav-menu__svg-icon--'.$args->menu->slug.' "><div class="c-svg-icon--'. $icon_class_mod .'"><svg preserveAspectRatio="none" class="c-svg-icon__svg"><use class="c-svg-icon__use"  xlink:href="' . $menu_item_icon_id  . '" /></svg></div></div>'.$title_markup;

        }
    }

    return $sorted_menu_objects;
}

//add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);

function my_wp_nav_menu_items( $items, $args ) {



//            echo '<pre>';
//        print_r($args);
//        echo '</pre>';

//    // get menu
//    $menu = wp_get_nav_menu_object($args->menu);
//
//
//    // modify primary only
//    if( $args->theme_location == 'top' ) {
//
//        // vars
//        $logo = get_field('logo', $menu);
//        $color = get_field('color', $menu);
//
//
//        // prepend logo
//        $html_logo = '<li class="menu-item-logo"><a href="'.home_url().'"><img src="'.$logo['url'].'" alt="'.$logo['alt'].'" /></a></li>';
//
//
//        // append style
//        $html_color = '<style type="text/css">.navigation-top{ background: '.$color.';}</style>';
//
//
//        // append html
//        $items = $html_logo . $items . $html_color;
//
//    }


    // return
    //return $items;

}
