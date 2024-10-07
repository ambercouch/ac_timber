<?php

add_action( 'acf/include_fields', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }


    acf_add_local_field_group( array(
        'key' => 'group_page_layout',
        'title' => 'Page Layout',
        'fields' => array (
            array (
                'key' => 'field_default_page_sidebar',
                'label' => 'Default Page Sidebar',
                'name' => 'default_page_sidebar',
                'type' => 'true_false',
                'instructions' => 'If this is checked pages will have a sidebar by default',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Use sidebar on pages',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-page-layout',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));


} );



