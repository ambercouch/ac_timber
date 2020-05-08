<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_5a06a13ca9b87',
        'title' => 'Before Content',
        'fields' => array (
            array(
                'key' => 'field_page_intro',
                'label' => 'Page intro',
                'name' => 'page_intro',
                'type' => 'textarea',
                'instructions' => 'Use when the page is output as a thumbnail. Similar to a post excerpt',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array (
                'key' => 'field_5a06a14d88987',
                'label' => 'Title Before Content',
                'name' => 'before_content_title',
                'type' => 'text',
                'value' => NULL,
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
            ),
            array (
                'key' => 'field_5a06a18988988',
                'label' => 'Text Before Content',
                'name' => 'before_content_text',
                'type' => 'text',
                'value' => NULL,
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
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
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
        'description' => 'A title and/or a line of text placed in a band before the main content',
    ));

endif;
