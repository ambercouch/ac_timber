<?php





    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array (
            'key' => 'group_577ce9869001d',
            'title' => 'Branding',
            'fields' => array (
                array (
                    'key' => 'field_577ce9999d0cb',
                    'label' => 'Company Logo',
                    'name' => 'company_logo',
                    'type' => 'image',
                    'instructions' => '300px by 60px works well as a default size.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '40',
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
                array(
                    'key' => 'field_5a7e180566c6f',
                    'label' => 'Logo width',
                    'name' => 'logo_width',
                    'type' => 'number',
                    'instructions' => 'Set the width of your logo in pixels. If blank the css default of 300px will be used.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '30',
                        'class' => 'acf-branding-lgw',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => 'px',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_5a7e180566123',
                    'label' => 'Logo height',
                    'name' => 'logo_height',
                    'type' => 'number',
                    'instructions' => 'Set the height of your logo in pixels. If blank the css default of 60px will be used.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '30',
                        'class' => 'acf-branding-lgw',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => 'px',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_default-brand-img',
                    'label' => 'Default Brand image',
                    'name' => 'default_brand_img',
                    'type' => 'image',
                    'instructions' => 'Add a default image that will be used when featured images are missing',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '100',
                        'class' => 'acf-branding-lgw',
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
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-general-settings',
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


