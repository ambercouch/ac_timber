<?php

//Add ACF options page
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'TVB Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> true
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'General Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Banner Settings',
        'menu_title'	=> 'Banner Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

//    acf_add_options_sub_page(array(
//        'page_title' 	=> 'Theme Footer Settings',
//        'menu_title'	=> 'Footer',
//        'parent_slug'	=> 'theme-general-settings',
//    ));

}

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_575ae11325ae5',
        'title' => 'Tile Details',
        'fields' => array (
            array (
                'key' => 'field_573c697a6eb09',
                'label' => 'Image Tile',
                'name' => 'image_tile',
                'type' => 'image',
                'instructions' => 'Upload an image of the tile.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'uploadedTo',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'tile',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

    acf_add_local_field_group(array (
        'key' => 'group_5ac23eac4dd1f',
        'title' => 'Tile Range',
        'fields' => array (
            array (
                'key' => 'field_5ac23eb9303ba',
                'label' => 'In-situ Image',
                'name' => 'in_situ_image',
                'type' => 'image',
                'instructions' => 'This image is displayed a the top of the tile range page and on the list page if no list image is selected.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5ac23fa1303bb',
                'label' => 'List image',
                'name' => 'list_image',
                'type' => 'image',
                'instructions' => 'This image is show on the tile range list page. If not selected the In-situ image will be used',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5ac24071303bc',
                'label' => 'Tile Description',
                'name' => 'tile_description',
                'type' => 'wysiwyg',
                'instructions' => 'A description of the tile',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array (
                'key' => 'field_5ac241b1303bd',
                'label' => 'Tile Groups',
                'name' => 'tile_groups',
                'type' => 'repeater',
                'instructions' => 'Add tile groups to this tile range',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => '',
                'max' => '',
                'layout' => 'block',
                'button_label' => 'Add a Tile Group',
                'sub_fields' => array (
                    array (
                        'key' => 'field_5ac24233303be',
                        'label' => 'Tile Group Title',
                        'name' => 'tile_group_title',
                        'type' => 'text',
                        'instructions' => 'The name of the group. eg. Porcelian Wall Floor 488x888 IN',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_5ac242c5303bf',
                        'label' => 'Tiles',
                        'name' => 'tiles',
                        'type' => 'relationship',
                        'instructions' => 'Choose some tiles',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array (
                            0 => 'tile',
                        ),
                        'taxonomy' => array (
                        ),
                        'filters' => array (
                            0 => 'search',
                        ),
                        'elements' => array (
                            0 => 'featured_image',
                        ),
                        'min' => '',
                        'max' => '',
                        'return_format' => 'object',
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'tile-range',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;