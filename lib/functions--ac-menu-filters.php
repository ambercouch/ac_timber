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

        $menu_item_icon = get_field('menu_icon', $menu_object);

        if ($menu_item_icon != ""){
            $icon_class_mod = str_replace("icon-","", $menu_item_icon);
            $menu_item_icon_id = "#".$menu_item_icon;

            $title_markup = false;
            if ($menu_object->attr_title != ""){
                $attr_title = str_replace('#', '', $menu_object->attr_title);
                $title_markup = '<div class="c-nav-menu__icon-title">'.$attr_title.'</div>';
            }

            $menu_object->title = '<div class="c-nav-menu__svg-icon"><div class="c-svg-icon--'. $icon_class_mod .'"><svg preserveAspectRatio="none" class="c-svg-icon__svg"><use class="c-svg-icon__use"  xlink:href="' . $menu_item_icon_id  . '" /></svg></div></div>'.$title_markup;

        }
    }

    return $sorted_menu_objects;
}
