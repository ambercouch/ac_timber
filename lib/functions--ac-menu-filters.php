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

        if (substr($menu_object->description, 0, 6) === "#icon-" ) {
            $icon_class = str_replace("#icon-","", $menu_object->description);

            $title_markup = false;
            if ($menu_object->attr_title != ""){
                $attr_title = str_replace('#', '', $menu_object->attr_title);
                $title_markup = '<div class="nav-menu__icon-title">'.$attr_title.'</div>';
            }


            $menu_object->title = '<div class="nav-menu__svg-icon"><div class="o-svg-icon--'. $icon_class .'"><svg preserveAspectRatio="none" class="o-svg-icon__svg"><use class="o-svg-icon__use"  xlink:href="' . $menu_object->description . '" /></svg></div></div>'.$title_markup;
        }


    }

    return $sorted_menu_objects;
}
