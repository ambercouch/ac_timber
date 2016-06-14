<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 14/06/2016
 * Time: 09:25
 */


// Video Overview
function actVideoOverview() {
    add_thickbox();
    ?>
    <p>Watch videos of basic user interaction and see how we imagine your site working.</p>
    <ul>
        <li><a href="https://drive.google.com/open?id=0B2_KLu_jilZdTXBTWkI5NlczakU&TB_iframe=true&width=600&height=550" class="thickbox">Home Page - Overview</a></li>
        <li><a href="https://drive.google.com/open?id=0B2_KLu_jilZdRk5OLUlVU1VqaWM&TB_iframe=true&width=600&height=550" class="thickbox">Our Work - Overview</a></li>
        <li><a href="https://drive.google.com/open?id=0B2_KLu_jilZdeUtUVlBGajk5OUk&TB_iframe=true&width=600&height=550" class="thickbox">Be Inspired - Overview</a></li>
        <li><a href="https://drive.google.com/open?id=0B2_KLu_jilZdMF9lMTFvY2pLOEk&TB_iframe=true&width=600&height=550" class="thickbox">Tile Gallery - Overview</a></li>

    </ul>

    <?php
}

// Dashboard Intro
function actDashboardIntro() {
    ?>
    <p>Welcome to the dashboard area of your website.</p>
    <p>Please view the included videos to learn more about your website.</p>
    <p>Thank you for choosing to work with <a href="//ambercouch.co.uk" >AmberCouch</a>. For support or additional features, please <a href="mailto:louise@ambercouch.co.uk"> email us.</a> </p>

    <?php
}


// calling all custom dashboard widgets
function bones_custom_dashboard_widgets() {
    wp_add_dashboard_widget( 'act-intro', __( 'Thomas Vaughan Website by AmberCouch', 'act' ), 'actDashboardIntro' );
    wp_add_dashboard_widget( 'act-video-overview', __( 'Website Video Overview', 'act' ), 'actVideoOverview' );
}

// adding any custom widgets
add_action( 'wp_dashboard_setup', 'bones_custom_dashboard_widgets' );
