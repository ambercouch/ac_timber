<?php

add_action( 'acf/include_fields', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key' => 'group_design_settings',
        'title' => 'Design Settings',
        'fields' => array(
            array(
                'key' => 'field_act_client_code',
                'label' => 'ACT Client Code',
                'name' => 'act_client_code',
                'type' => 'text',
                'instructions' => 'Set the client code that can be used as a css class to override css selectors<br> <i>.client-code-xxx</i>',
                'wrapper' => array(
                    'width' => '50',
                ),
                'default_value' => '',
                'maxlength' => 5,
                'placeholder' => 'xxx',
                'prepend' => '.client-code-',
                'append' => '',
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-design-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'field',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_brand_colours',
        'title' => 'Brand Colours',
        'fields' => array(
            array(
                'key' => 'field_act_brand_colour_1',
                'label' => 'ACT Brand Colour 1',
                'name' => 'act_brand_colour_1',
                'type' => 'color_picker',
                'instructions' => 'Typically used for your primary brand colour',
                'wrapper' => array(
                    'width' => '50',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_2',
                'label' => 'ACT Brand Colour 2',
                'name' => 'act_brand_colour_2',
                'type' => 'color_picker',
                'instructions' => 'Typically used for your secondary brand colour',
                'wrapper' => array(
                    'width' => '50',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-colour-palette',
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
    ));

    acf_add_local_field_group( array(
        'key' => 'group_supporting_colours',
        'title' => 'Supporting Colours',
        'fields' => array(
            array(
                'key' => 'field_act_brand_colour_3',
                'label' => 'ACT Brand Colour 3',
                'name' => 'act_brand_colour_3',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a supporting colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_4',
                'label' => 'ACT Brand Colour 4',
                'name' => 'act_brand_colour_4',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a supporting colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_5',
                'label' => 'ACT Brand Colour 5',
                'name' => 'act_brand_colour_5',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a supporting colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-colour-palette',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_dark_light_colours',
        'title' => 'Brand Dark and Light Colours',
        'fields' => array(
            array(
                'key' => 'field_act_brand_colour_6',
                'label' => 'ACT Brand Colour 6',
                'name' => 'act_brand_colour_6',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a brand dark colour',
                'wrapper' => array(
                    'width' => '50',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_7',
                'label' => 'ACT Brand Colour 7',
                'name' => 'act_brand_colour_7',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a brand light colour',
                'wrapper' => array(
                    'width' => '50',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-colour-palette',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_user_info_colours',
        'title' => 'Brand User Info Colours',
        'fields' => array(
            array(
                'key' => 'field_act_brand_colour_8',
                'label' => 'ACT Brand Colour 8',
                'name' => 'act_brand_colour_8',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a user success colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_9',
                'label' => 'ACT Brand Colour 9',
                'name' => 'act_brand_colour_9',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a user fail colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_act_brand_colour_10',
                'label' => 'ACT Brand Colour 10',
                'name' => 'act_brand_colour_10',
                'type' => 'color_picker',
                'instructions' => 'Typically used for a user warning colour',
                'wrapper' => array(
                    'width' => '33',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-colour-palette',
                ),
            ),
        ),
        'menu_order' => 3,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group( array(
        'key' => 'group_colours',
        'title' => 'Theme Colours',
        'fields' => array(
            // Header Background Colour
            array(
                'key' => 'field_header_background',
                'label' => 'Header Background',
                'name' => 'header_background',
                'type' => 'select',
                'instructions' => 'Select the background colour for the header',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            // Header Text Colour
            array(
                'key' => 'field_header_text_colour',
                'label' => 'Header Text Colour',
                'name' => 'header_text_colour',
                'type' => 'select',
                'instructions' => 'Select the text colour for the header',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            // Header Link Colour
            array(
                'key' => 'field_header_link_colour',
                'label' => 'Header Link Colour',
                'name' => 'header_link_colour',
                'type' => 'select',
                'instructions' => 'Select the link colour for the header',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),

            // Body Section Fields
            array(
                'key' => 'field_body_background',
                'label' => 'Body Background',
                'name' => 'body_background',
                'type' => 'select',
                'instructions' => 'Select the background colour for the body',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_body_text_colour',
                'label' => 'Body Text Colour',
                'name' => 'body_text_colour',
                'type' => 'select',
                'instructions' => 'Select the text colour for the body',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_body_header_colour',
                'label' => 'Body Header Colour',
                'name' => 'body_header_colour',
                'type' => 'select',
                'instructions' => 'Select the header colour for the body',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_body_link_colour',
                'label' => 'Body Link Colour',
                'name' => 'body_link_colour',
                'type' => 'select',
                'instructions' => 'Select the link colour for the body',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),


            // Footer Section Fields
            array(
                'key' => 'field_footer_background',
                'label' => 'Footer Background',
                'name' => 'footer_background',
                'type' => 'select',
                'instructions' => 'Select the background colour for the footer',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_footer_text_colour',
                'label' => 'Footer Text Colour',
                'name' => 'footer_text_colour',
                'type' => 'select',
                'instructions' => 'Select the text colour for the footer',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_footer_header_colour',
                'label' => 'Footer Header Colour',
                'name' => 'footer_header_colour',
                'type' => 'select',
                'instructions' => 'Select the header colour for the footer',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_footer_link_colour',
                'label' => 'Footer Link Colour',
                'name' => 'footer_link_colour',
                'type' => 'select',
                'instructions' => 'Select the link colour for the footer',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),




            // Footer Info Background Colour
            array(
                'key' => 'field_footer_info_background',
                'label' => 'Footer Info Background',
                'name' => 'footer_info_background',
                'type' => 'select',
                'instructions' => 'Select the background colour for the footer info section',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            // Footer Info Text Colour
            array(
                'key' => 'field_footer_info_text_colour',
                'label' => 'Footer Info Text Colour',
                'name' => 'footer_info_text_colour',
                'type' => 'select',
                'instructions' => 'Select the text colour for the footer info section',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            // Footer Info Link Colour
            array(
                'key' => 'field_footer_info_link_colour',
                'label' => 'Footer Info Link Colour',
                'name' => 'footer_info_link_colour',
                'type' => 'select',
                'instructions' => 'Select the link colour for the footer info section',
                'choices' => array(
                    '1' => 'Brand Colour 1',
                    '2' => 'Brand Colour 2',
                    '3' => 'Brand Colour 3',
                    '4' => 'Brand Colour 4',
                    '5' => 'Brand Colour 5',
                    '6' => 'Brand Colour 6',
                    '7' => 'Brand Colour 7',
                    '8' => 'Brand Colour 8',
                    '9' => 'Brand Colour 9',
                    '10' => 'Brand Colour 10',
                ),
                'default_value' => false,
                'allow_null' => 1,
                'multiple' => 0,
                'wrapper' => array(
                    'width' => '33',
                ),
            ),



        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-theme-colours',
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



