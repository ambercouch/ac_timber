<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_hero_banner',
        'title' => 'Hero Banner',
        'fields' => array (
            array (
                'key' => 'field_remove_hero_banner',
                'label' => 'Remove Hero Banner',
                'name' => 'remove_hero_banner',
                'type' => 'true_false',
                'instructions' => 'If this is checked hero banner will be removed from the homepage.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Remove hero banner',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-hero-banner',
                ),
            ),
        ),
        'menu_order' => -1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;