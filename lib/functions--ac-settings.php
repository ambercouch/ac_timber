<?php



//Define your sidebars here
define('SIDEBARS', serialize(array('Primary','Subsidiary','Footer')));


    function acSettings()
    {
        $settings['svgLogo'] = null;
        $settings['defaultImage'] = null;
        $settings['typeKitId'] = 'fez6iab';
        $settings['sidebars'] = unserialize(ACT_SIDEBARS);
        return $settings;
    }
