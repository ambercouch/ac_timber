<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_masthead',
        'title' => 'Masthead',
        'fields' => array (
            array (
                'key' => 'field_overlay_hero_banner',
                'label' => 'Overlay Hero Banner',
                'name' => 'overlay_hero_banner',
                'type' => 'true_false',
                'instructions' => 'If this is checked the masthead will be on a transparent background over the hero banner.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Overlay hero banner',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-masthead',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;