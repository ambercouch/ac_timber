<?php

add_filter('wp_nav_menu_objects', 'ad_filter_menu', 10, 2);

function ad_filter_menu($sorted_menu_objects, $args) {


  if ($args->theme_location == 'services') {
    // edit the menu objects
    foreach ($sorted_menu_objects as $menu_object) {
      // searching for menu items linking to posts or pages
      // can add as many post types to the array
      if (in_array($menu_object->object, array(' post', 'page', 'any_post_type'))) {
        // set the title to the post_thumbnail if available
        // thumbnail size is the second parameter of get_the_post_thumbnail()
        $menu_object->title = has_post_thumbnail($menu_object->object_id) ? '<span class = "menu--services__wrapper" >' . get_the_post_thumbnail($menu_object->object_id, 'thumbnail') . '<span class = "menu--services__title">' . $menu_object->title . '</span></span> ' : $menu_object->title;
      }
    }
  }

  foreach ($sorted_menu_objects as $menu_object) {

    $xfn_array = explode(' ', $menu_object->xfn);
    $icon_class = FALSE;
    foreach ($xfn_array as $key) {
      if (ac_contains($key, 'icon') !== FALSE) {
        $icon_class = $key;
      }
    }
    if ($icon_class !== FALSE) {
      $menu_object->classes[] = 'menu__item--icon';
      $menu_object->title = $menu_object->xfn == '' ? $menu_object->title : '<svg preserveAspectRatio="none" class="icon menu__icon "><use class="icon__use--hover-off"  xlink:href="#' . $menu_object->xfn . '" /><use class="icon__use--hover-on"  xlink:href="#' . $menu_object->xfn . '--rgb" /></svg>';
    }
  }

  return $sorted_menu_objects;
}

add_filter('wp_nav_menu_objects', 'page_modal', 10, 2);

function page_modal($sorted_menu_objects, $args) {
  global $ac_section;
  foreach ($sorted_menu_objects as $key => $menu_object) {
    if ('#page_modal#' == $menu_object->url && get_field('video_url', $ac_section->ID) != '') {

      $menu_object->url = '#page-modal-' . $ac_section->ID;
    } elseif ('#page_modal#' == $menu_object->url && get_field('video_url', $ac_section->ID) == '') {
      unset($sorted_menu_objects[$key]);
    }
  }
  return $sorted_menu_objects;
}
