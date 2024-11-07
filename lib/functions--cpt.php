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

    /*
         * Include Case Studies
         */

    //require_once get_template_directory() . '/lib/cpt/cpt.case-studies.php';

    /*
     * Include Case Studies
     */

    //require_once get_template_directory() . '/lib/cpt/cpt.faqs.php';



}

add_action('init', 'act_cpt');
