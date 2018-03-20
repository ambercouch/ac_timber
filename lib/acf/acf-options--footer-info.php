<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_57ea5c33b2bbf',
        'title' => 'Footer Settings',
        'fields' => array (
            array (
                'key' => 'field_57ea5c4cc30f5',
                'label' => 'Site Info',
                'name' => 'site_info',
                'type' => 'wysiwyg',
                'instructions' => 'Add the basic copyright	and developer info.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '<p>© [act_bloginfo key=\'name\' ] [act_date]
<span class="sep"> | </span>
<a title="Website Design Cardiff" href="http://ambercouch.co.uk/"> AmberCouch - Website Designer Cardiff</a></p>',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
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