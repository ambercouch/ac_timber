<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_post_setting',
        'title' => 'Post Settings',
        'fields' => array (
            array (
                'key' => 'field_hide_post_title',
                'label' => 'Hide Title',
                'name' => 'hide_post_title',
                'type' => 'true_false',
                'instructions' => 'This option will remove the title from this page',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Hide',
                'default_value' => 0,
                'ui' => 1,
            ),
            array (
                'key' => 'field_hide_featured_image',
                'label' => 'Hide Featured Image',
                'name' => 'hide_featured_image',
                'type' => 'true_false',
                'instructions' => 'This option will hide the featured image on this post',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Hide',
                'default_value' => 0,
                'ui' => 1,
            ),
            array (
                'key' => 'field_show_share_links',
                'label' => 'Show Share Links',
                'name' => 'show_share_links',
                'type' => 'true_false',
                'instructions' => 'This option will display share links on this post',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Show',
                'default_value' => 1,
                'ui' => 1,
            ),
            array (
                'key' => 'field_title_position',
                'label' => 'Title Position',
                'name' => 'title_position',
                'type' => 'button_group',
                'instructions' => 'Choose whether the title appears above or below the featured image',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                        array (
                            'field' => 'field_hide_title',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                        array (
                            'field' => 'field_hide_featured_image',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'above' => 'Above Featured Image',
                    'below' => 'Below Featured Image',
                ),
                'default_value' => 'above',
                'allow_null' => 0,
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));



endif;