<?php

    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array (
            'key' => 'group_575db9580c96d',
            'title' => 'Contact Info',
            'fields' => array (
                array (
                    'key' => 'field_575db99523c3e',
                    'label' => 'Contact',
                    'name' => 'contact',
                    'type' => 'repeater',
                    'instructions' => '',
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
                    'layout' => 'table',
                    'button_label' => 'Add Row',
                    'sub_fields' => array (
                        array (
                            'key' => 'field_575db9d723c3f',
                            'label' => 'Contact Label',
                            'name' => 'contact_label',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
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
                            'key' => 'field_575dba1423c40',
                            'label' => 'Contact Type',
                            'name' => 'contact_type',
                            'type' => 'radio',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array (
                                'tel' => 'Telephone',
                                'email' => 'Email',
                                'url' => 'Website',
                                'other' => 'Other',
                            ),
                            'allow_null' => 1,
                            'other_choice' => 0,
                            'save_other_choice' => 0,
                            'default_value' => '',
                            'layout' => 'vertical',
                        ),
                        array (
                            'key' => 'field_575dba7423c41',
                            'label' => 'Contact URL',
                            'name' => 'contact_url',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => array (
                                array (
                                    array (
                                        'field' => 'field_575dba1423c40',
                                        'operator' => '==',
                                        'value' => 'url',
                                    ),
                                ),
                            ),
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array (
                            'key' => 'field_575dbcc23b1c2',
                            'label' => 'Contact Tel',
                            'name' => 'contact_tel',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => '',
                            'conditional_logic' => array (
                                array (
                                    array (
                                        'field' => 'field_575dba1423c40',
                                        'operator' => '==',
                                        'value' => 'tel',
                                    ),
                                ),
                            ),
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
                            'key' => 'field_575dbd0f3b1c3',
                            'label' => 'Contact Email',
                            'name' => 'contact_email',
                            'type' => 'email',
                            'instructions' => '',
                            'required' => '',
                            'conditional_logic' => array (
                                array (
                                    array (
                                        'field' => 'field_575dba1423c40',
                                        'operator' => '==',
                                        'value' => 'email',
                                    ),
                                ),
                            ),
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        array (
                            'key' => 'field_575dbdca3b1c4',
                            'label' => 'Contact Info',
                            'name' => 'contact_info',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => array (
                                array (
                                    array (
                                        'field' => 'field_575dba1423c40',
                                        'operator' => '==',
                                        'value' => 'other',
                                    ),
                                ),
                            ),
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
                    ),
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-general',
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