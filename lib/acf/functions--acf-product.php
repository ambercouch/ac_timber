<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_601fcbf103f4b',
        'title' => 'Product',
        'fields' => array(
            array(
                'key' => 'field_601fcc2f9e489',
                'label' => 'Product Badge Image',
                'name' => 'image_product_badge',
                'type' => 'image',
                'instructions' => 'Upload an image to display as a badge on the product gallery',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_601fccd79e48a',
                'label' => 'Product Badge Position',
                'name' => 'product_badge_position',
                'type' => 'select',
                'instructions' => 'Select where on the product image you would like the badge to be positioned or sellect Hidden to remove the badge',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'hidded' => 'Hidden',
                    'top-left' => 'Top Left',
                    'top-right' => 'Top Right',
                    'bottom-right' => 'Bottom Right',
                    'bottom-left' => 'Bottom Left',
                ),
                'default_value' => 'hidden',
                'allow_null' => 1,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
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

endif;
