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
                'key' => 'field_page_force_show_masthead',
                'label' => 'Show the masthead above the hero',
                'name' => 'page_force_show_masthead',
                'type' => 'true_false',
                'instructions' => 'This option will show the masthead above the hero even if the global option is to overlay it.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Don\'t Overlay Masthead',
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
    acf_add_local_field_group(array (
        'key' => 'group_page_settings_front_page',
        'title' => 'Page Settings Front Page',
        'fields' => array (
            array (
                'key' => 'field_hide_site_hero',
                'label' => 'Hide the site hero banner',
                'name' => 'hide_site_hero',
                'type' => 'true_false',
                'instructions' => 'This will remove the site hero on the home page which is shown by default',
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
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
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
    acf_add_local_field_group(array (
        'key' => 'group_page_settings_content_page',
        'title' => 'Page Settings Content Page',
        'fields' => array (
            array (
                'key' => 'field_show_site_hero',
                'label' => 'Show the site hero banner',
                'name' => 'show_site_hero',
                'type' => 'true_false',
                'instructions' => 'This will show the site hero which is removed by default',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Show',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'front_page',
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
