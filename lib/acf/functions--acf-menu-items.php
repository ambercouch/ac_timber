<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_menu_items',
        'title' => 'Menu Items',
        'fields' => array(
            array(
                'key' => 'field_menu_icon',
                'label' => 'Menu Icon',
                'name' => 'menu_icon',
                'type' => 'text',
                'instructions' => 'add the id of an svg icon eg. icon-twitter',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '#',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_show_label',
                'label' => 'Show Label',
                'name' => 'show_label',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_menu_icon',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_icon_position',
                'label' => 'Icon Position',
                'name' => 'icon_position',
                'type' => 'button_group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_show_label',
                            'operator' => '==',
                            'value' => '1',
                        ),
                        array(
                            'field' => 'field_menu_icon',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'left' => 'Left',
                    'right' => 'Right',
                ),
                'allow_null' => 0,
                'default_value' => 'left',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
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
