<?php


    function acSettings()
    {
        $settings['svgLogo'] = null;
        $settings['defaultImage'] = null;
        $settings['typeKitId'] = 'hej7ovh';
        $settings['sidebars'] = unserialize(ACT_SIDEBARS);
        $settings['bannerImg']['url'] = get_stylesheet_directory_uri().'/assets/images/jpg/act-default.jpg';
        $settings['bannerImg']['alt'] = 'AmberCouch Timber Theme';
        return $settings;
    }
