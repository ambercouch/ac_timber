<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_before_content',
        'title' => 'Before Content',
        'fields' => array (
            array (
                'key' => 'field_before_content_type',
                'label' => 'Before Content Type',
                'name' => 'before_content_type',
                'type' => 'button_group',
                'instructions' => 'Select the type of content',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'none' => 'None',
                    'simple' => 'Simple',
                    'advanced' => 'Advanced',
                ),
                'allow_null' => 0,
                'default_value' => 'none',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
            array (
                'key' => 'field_before_content_title',
                'label' => 'Before Content Simple Title',
                'name' => 'before_content_title',
                'type' => 'text',
                'instructions' => 'Add a title before the content',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_before_content_type',
                            'operator' => '==',
                            'value' => 'simple',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            ),
            array (
                'key' => 'field_before_content_text',
                'label' => 'Before Content Simple Text',
                'name' => 'before_content_text',
                'type' => 'text',
                'instructions' => 'Add some text before the main content',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_before_content_type',
                            'operator' => '==',
                            'value' => 'simple',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            ),
            array (
                'key' => 'field_before_content_advanced',
                'label' => 'Before Content',
                'name' => 'before_content_advanced',
                'type' => 'wysiwyg',
                'instructions' => 'Add text that appear before main content',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_before_content_type',
                            'operator' => '==',
                            'value' => 'advanced',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-blog-settings',
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
