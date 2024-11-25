<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_masthead',
        'title' => 'Masthead',
        'fields' => array (
            array(
                'key' => 'field_masthead_style',
                'label' => 'Masthead Style',
                'name' => 'masthead_style',
                'type' => 'select',
                'instructions' => 'Select the masthead style.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'static' => 'Static Solid',
                    'overlay' => 'Static Overlay',
                    'sticky' => 'Sticky',
                    'smart' => 'Smart Sticky'
                ),
                'default_value' => 'static',
                'allow_null' => 0,
                'multiple' => 0,
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
