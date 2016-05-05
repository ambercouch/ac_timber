<?php

/*
 * Some settings
 */


//Define your sidebars here
define('SIDEBARS', serialize(array('Primary','Footer')));

function acSettings()
    {
        $settings['svgLogo'] = 'icon-thomas-vaughan-bathrooms-logo';
        $settings['defaultImage'] = null;
        $settings['typeKitId'] = 'hej7ovh';
        return $settings;
    }
