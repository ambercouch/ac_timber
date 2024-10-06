<?php


    function acSettings()
    {
        $settings['svgLogo'] = null;
        $settings['defaultImage'] = null;
        $settings['typeKitId'] = (get_field('typekit_id', 'options') != '' )? get_field('typekit_id', 'options') : 'uga0lgj';
        $settings['sidebars'] = unserialize(ACT_SIDEBARS);
        $settings['bannerImg']['url'] = get_stylesheet_directory_uri().'/assets/images/jpg/act-default.jpg';
        $settings['bannerImg']['sizes']['featureMobile'] = get_stylesheet_directory_uri().'/assets/images/jpg/act-default-400x800.jpg';
        $settings['bannerImg']['sizes']['feature16-9'] = get_stylesheet_directory_uri().'/assets/images/jpg/act-default-1600x900.jpg';
        $settings['bannerImg']['alt'] = 'AmberCouch Timber Theme 123';
        $settings['colourPallet'] = array(
            'act_amber' => '#e59700',
            'act_electric_blue' => '#00A0E9',
            'act_steel_grey' => '#6D7B8D',
            'act_slate_grey' => '#495A67',
            'act_charcoal_grey' => '#313A44',
            'act_ashen_black' => '#1C232A',
            'act_off_white' => '#E6E8ED',
            'act_success_green' => '#28a745',
            'act_fail_red' => '#dc3545',
        );
        $settings['brandColour'] = array(
            '1' => '#e59700',
            '2' => '#00A0E9',
            '3' => '#6D7B8D',
            '4' => '#495A67',
            '5' => '#313A44',
            '6' => '#1C232A',
            '7' => '#E6E8ED',
            '8' => '#28a745',
            '9' => '#dc3545',
            '10' => '#e59700',
        );
        return $settings;
    }

// Original SASS Variables



