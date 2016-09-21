<?php



//Define your sidebars here
define('SIDEBARS', serialize(array('Primary','Subsidiary','Footer')));


    function acSettings()
    {
        $settings['svgLogo'] = null;
        $settings['defaultImage'] = null;
        $settings['typeKitId'] = 'hej7ovh';
        $settings['sidebars'] = unserialize(SIDEBARS);
        return $settings;
    }
