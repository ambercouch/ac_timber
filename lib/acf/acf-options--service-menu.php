<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_service_menu',
        'title' => 'Service Menu',
        'fields' => array (
            array (
                'key' => 'field_service-menu-hover-excerpt',
                'label' => 'Show Service Excerpt',
                'name' => 'show_service_excerpt',
                'type' => 'true_false',
                'instructions' => 'If this is checked the service excerpt will appear will show when hovering on a service menu item.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Show excerpt on hover',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-service-settings',
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