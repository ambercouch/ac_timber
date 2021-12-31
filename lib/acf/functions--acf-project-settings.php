<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_project_settings',
        'title' => 'Project Settings',
        'fields' => array (
            array (
                'key' => 'field_hide_project_content_link',
                'label' => 'Hide Project Content Link',
                'name' => 'hide_project_content_link',
                'type' => 'true_false',
                'instructions' => 'This option will remove link to the content form the project menu',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Hide the link',
                'default_value' => 1,
            ),
            array (
                'key' => 'field_project_url',
                'label' => 'Project url',
                'name' => 'project_url',
                'type' => 'text',
                'instructions' => 'Link to the project website',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
            array(
                'key' => 'field_project_thumb_title',
                'label' => 'Project Short Name',
                'name' => 'project_thumb_title',
                'type' => 'text',
                'instructions' => 'Add a short name for the project that will show on the list view. Will fall back to the Project Title.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '30',
            ),
             array(
                 'key' => 'field_project_icon',
                 'label' => 'Project Icon',
                 'name' => 'custom_post_icon',
                 'type' => 'image',
                 'instructions' => 'Add an icon to the project',
                 'required' => 0,
                 'conditional_logic' => 0,
                 'wrapper' => array(
                     'width' => '',
                     'class' => '',
                     'id' => '',
                 ),
                 'return_format' => 'array',
                 'preview_size' => 'thumbnail',
                 'library' => 'uploadedTo',
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
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
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
        'key' => 'group_project_additional_content',
        'title' => 'Project Content',
        'fields' => array (
            array(
                'key' => 'field_project_intro_content',
                'label' => 'Project Intro Content',
                'name' => 'project_intro_content',
                'type' => 'wysiwyg',
                'instructions' => 'Add a sentence or 2 to overlay on the image.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
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
            array(
                'key' => 'field_project_background_image',
                'label' => 'Project Background Image',
                'name' => 'project_background_image',
                'type' => 'image',
                'instructions' => 'Add a background image for the project',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'uploadedTo',
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
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
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
