<?php
if( function_exists('acf_add_local_field_group') ):

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
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            )

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