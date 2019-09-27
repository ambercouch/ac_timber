<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_57e28e3190931',
        'title' => 'Page Settings',
        'fields' => array (
            array (
                'key' => 'field_57e28e51c2cd6',
                'label' => 'Hide Title',
                'name' => 'hide_title',
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
            ),
            array (
                'key' => 'field_57e28e51c2cd7',
                'label' => 'Hide Masthead',
                'name' => 'hide_site_masthead',
                'type' => 'true_false',
                'instructions' => 'This option will hide the masthead (logo nav etc) from this page',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Hide',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_show_page_comments',
                'label' => 'Show Page Comments',
                'name' => 'show_page_comments',
                'type' => 'true_false',
                'instructions' => 'This option will show the page comment even if they are hidden globally',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Show Comments',
                'default_value' => 0,
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
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;
