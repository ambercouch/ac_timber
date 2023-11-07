<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_favicon',
        'title' => 'Site Favicon',
        'fields' => array (
            array (
                'key' => 'field_favicon',
                'label' => 'Favicon',
                'name' => 'favicon',
                'type' => 'image',
                'instructions' => 'Upload a 192px x 192px png will work best',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array', // Set the return format to 'array' to get image details
                'preview_size' => 'thumbnail', // Set the size of the image preview
                'min_width' => 180, // Set the minimum width of the image
                'min_height' => 180, // Set the minimum height of the image
                'max_width' => 500, // Set the maximum width of the image
                'max_height' => 500, // Set the maximum height of the image
                'mime_types' => 'jpg,jpeg,png'
                // Add any other relevant settings or parameters here
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-global',
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
