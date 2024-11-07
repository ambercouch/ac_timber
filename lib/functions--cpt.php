<?php
function act_cpt() {

    /*
     * Include Service
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.service.php';

    /*
     * Includes Team member
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.team-member.php';

    /*
     * Include Project
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.project.php';

    /*
     * Include Vacancy
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.vacancy.php';

    /*
     * Include Testimonial
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.testimonial.php';

}

add_action('init', 'act_cpt');
