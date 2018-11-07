<?php
if( function_exists('acf_add_local_field_group') ):
        //test comment
    acf_add_local_field_group(array (
        'key' => 'group_service_settings',
        'title' => 'Service Settings',
        'fields' => array (
            array (
                'key' => 'field_hide_service_content_link',
                'label' => 'Hide Service Content Link',
                'name' => 'hide_service_content_link',
                'type' => 'true_false',
                'instructions' => 'This option will remove link to the content form the service menu',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Hide the link',
                'default_value' => 1,
            ),
            array (
                'key' => 'field_service_image_internal',
                'label' => 'Service Image',
                'name' => 'service_image_internal',
                'type' => 'image',
                'instructions' => 'This image will be shown on this service page. If no image is used then the featured image will be used',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '50',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_service_image_position_horizontal',
                'label' => 'Service Image Horizontal Position',
                'name' => 'service_image_position_horizontal',
                'type' => 'text',
                'instructions' => 'This setting will position the image horizontally from 0% (fully right) to 100% (fully left) default is 50%(centred).',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '50%',
                'prepend' => '',
                'append' => '',
                'min' => 0,
                'max' => 100,
                'step' => 10,
            ),
            array (
                'key' => 'field_service_image_height',
                'label' => 'Service Image height',
                'name' => 'service_image_height',
                'type' => 'text',
                'instructions' => 'set the height of the image 100% is the default but you can use a percentage eg. 50% or \'auto\'',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'auto',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),

        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
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