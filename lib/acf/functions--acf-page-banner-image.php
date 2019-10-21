<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_page_banner_image',
        'title' => 'Page Banner Image',
        'fields' => array (
            array (
                'key' => 'field_page_banner_image',
                'label' => 'Page Banner Image',
                'name' => 'page_banner_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_page_banner_image_height',
                'label' => 'Page Banner Image Height',
                'name' => 'page_banner_image_height',
                'type' => 'text',
                'instructions' => 'Set the height of the banner image 100px 100% or 100vh will all work',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '25',
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
            array(
                'key' => 'field_page_banner_image_position_horizontal',
                'label' => 'Position',
                'name' => 'page_banner_image_position_horizontal',
                'type' => 'select',
                'instructions' => 'Set the horizontal position of the banner image',
                'required' => 0,
                'wrapper' => array(
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'center' => 'Center',
                    'bottom' => 'Bottom',
                    'top' => 'Top'
                ),
                'default_value' => array(
                    0 => 'centre',
                    1 => 'bottom',
                    2 => 'top'
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_page_banner_image_saturation',
                'label' => 'Image Saturation',
                'name' => 'page_banner_image_saturation',
                'type' => 'number',
                'instructions' => 'Adjust the image saturation',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '%',
                'min' => '',
                'max' => 100,
                'step' => '10',
            ),
            array(
                'key' => 'field_page_banner_image_colour_cast',
                'label' => 'Image Colour Cast',
                'name' => 'page_banner_image_colour_cast',
                'type' => 'true_false',
                'instructions' => 'Enable a colour overlay on the banner image.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 0,
                'message' => '',
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_page_banner_image_colour_cast_colour',
                'label' => 'Image Colour Cast Colour',
                'name' => 'page_banner_image_colour_cast_colour',
                'type' => 'color_picker',
                'instructions' => 'Pick a colour for the image overlay. Can also be used as a background colour.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5b8fb0b845cbc',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
            array(
                'key' => 'field_page_banner_image_colour_cast_opacity',
                'label' => 'Image Colour Cast Opacity',
                'name' => 'page_banner_image_colour_cast_opacity',
                'type' => 'range',
                'instructions' => 'Set the opacity of the colour overlay.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5b8fb0b845cbc',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '0.2',
                'min' => '',
                'max' => 1,
                'step' => '0.1',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_page_banner_image_color_cast_mode',
                'label' => 'Image Color Cast Mode',
                'name' => 'page_banner_image_colour_cast_mode',
                'type' => 'select',
                'instructions' => 'Select the colour mode for the color overlay',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5b8fb0b845cbc',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'Normal' => 'Normal',
                    'Multiply' => 'Multiply',
                    'Hard Light' => 'Hard Light',
                    'Difference' => 'Difference',
                ),
                'default_value' => array(
                    0 => 'normal',
                    1 => 'multiply',
                    2 => 'hard-light',
                    3 => 'difference',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
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
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
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



