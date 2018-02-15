<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_59d76d4592282',
        'title' => 'Banner Menu',
        'fields' => array (
            array (
                'key' => 'field_59d76d4f62305',
                'label' => 'Remove Banner Menu',
                'name' => 'hide_banner_menu',
                'type' => 'true_false',
                'instructions' => 'If this is checked remove the hero menu from the banner.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Remove meue',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-banner-settings',
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