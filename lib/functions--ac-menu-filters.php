<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 09/01/2018
 * Time: 16:11
 */

add_filter('wp_nav_menu_objects', 'act_menu_filters', 10, 2);

function act_menu_filters($sorted_menu_objects, $args) {

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

            $menu_object->title = '<div class="c-nav-menu__svg-icon "><div class="c-svg-icon--'. $icon_class_mod .'"><svg preserveAspectRatio="none" class="c-svg-icon__svg"><use class="c-svg-icon__use"  xlink:href="' . $menu_item_icon_id  . '" /></svg></div></div>'.$title_markup;

        }
    }

    return $sorted_menu_objects;
}
