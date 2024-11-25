<?php


// [act_date] prints todays date (default is Year)
add_shortcode( 'act_date', 'act_date' );
function act_date( $atts ){

    $a = (isset($atts[0]))? $atts[0] : 'Y';

    return date($a);
}

// [act_bloginfo key='name'] prints blog info
add_shortcode('act_bloginfo', 'act_bloginfo');
function act_bloginfo( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_bloginfo($key);
}

//[act_themesettings key='company_name'] print any of the blog theme options eg 'company_name'
add_shortcode('act_theme_settings', 'act_theme_settings');
function act_theme_settings( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_field($key, 'options');
}


//[act_contact row='1' type='item'] prints a row from the contact info formatted as item, value or link
add_shortcode('act_contact', 'act_contact');
function act_contact( $atts ) {
    extract(shortcode_atts(array(
        'row' => 1,
        'type' => 'item',
        'event_label' => 'acContact'
    ), $atts));

    //return 'contact' . $row;
    $contact_items = get_field('contact', 'options');
    $contact_item = $contact_items[$row - 1];
    $contact_type = $contact_item['contact_type'];
    $contact_label = $contact_item['contact_label'];
    $contact_value_key = 'contact_'.$contact_type;
    $contact_value = $contact_item[$contact_value_key];

    switch ($contact_type){
        case 'email':
            $contact_link = '<a  data-vars-ga-label="'.$event_label.'" href="mailto:'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'tel':
            $contact_link = '<a data-vars-ga-label="'.$event_label.'"  href="tel:'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'website':
            $contact_link = '<a href="'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'other':
            $contact_link = $contact_value;
            break;
        default :
            $contact_link = $contact_value;
    }

    $output = '';
    switch ($type){
        case 'item' :
            $output .= '<div class="c-company-contact-item">';
            $output .= '<span class="c-company-contact-item__label">';
            $output .= $contact_label;
            $output .= '</span>';
            $output .= '<span class="c-company-contact-item__sep"> : </span>';
            $output .= '<span class="c-company-contact-item__value">';
            $output .= $contact_link;
            $output .= '</span">';
            $output .= '</div>';
            break;
        case 'value':
            $output .= $contact_value;
            break;
        case 'label':
            $output .= $contact_label;
            break;
        case 'link':
            $output .= $contact_link;
            break;
        default:
            $output .= $contact_value;
            break;
    }

    return $output;
}


//[act_contact row='1' type='item'] prints a row from the contact info formatted as item, value or link
add_shortcode('act_address', 'act_address_schema');
function act_address_schema($atts){

    extract(shortcode_atts(array(
        'hide' => '',
    ), $atts));

    $hidden = [];
    if($hide != ''){
        $hidden = explode(',', preg_replace('/\s/', '', $hide));
    }


    $company_name = get_field('company_name', 'options');
    $street_address = get_field('street_address', 'options');
    $address_locality = get_field('address_locality', 'options');
    $city = get_field('city', 'options');
    $postcode = get_field('postcode', 'options');

    $output = '';
    $output .= '<div class="c-company-details">';
    $output .= '<div class="c-company-details__company" itemscope itemtype="http://schema.org/LocalBusiness">';
    if ($company_name != '' && !in_array('company_name', $hidden)){
        $output .= '<h1 class="c-company-details__heading">';
        $output .= '<span class="c-company-details__name" itemprop="name">'.$company_name.'</span>';
        $output .= '</h1>';
    }
    $output .= '<div class="c-company-details__address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
    if ($street_address != ''){
        $output .= '<span class="c-company-details__address-line--street" itemprop="streetAddress">'.$street_address.'</span>';
    }
    if ($address_locality != ''){
        $output .= '<span class="c-company-details__address-line--locality" itemprop="addressLocality">'.$address_locality.'</span>';
    }
    if ($city != ''){
        $output .= '<span class="c-company-details__address-line--region" itemprop="addressRegion">'.$city.'</span>';
    }
    if ($postcode != ''){
        $output .= '<span class="c-company-details__address-line--postcode" itemprop="postalCode">'.$postcode .'</span>';
    }
    $output .= ' </div><!-- itemprop="address" -->';
    $output .= '</div><!-- itemtype="http://schema.org/LocalBusiness" -->';
    $output .= '</div><!-- .c-company-address -->';


    return $output;
}

add_shortcode('act_logo', 'act_logo');
function act_logo($atts){
    extract(shortcode_atts(array(
        'w' => '300',
    ), $atts));

    $output = "";
    $logo = get_field('company_logo_colour', 'options');
    if($logo){
        $output = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" width="'.$w.'">';
    }

    return $output;
}

add_shortcode('act_logo_light', 'act_logo_light');
function act_logo_light($atts){

    extract(shortcode_atts(array(
        'w' => '300',
    ), $atts));

    $logo = get_field('company_logo_light', 'options');
    $output = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" width="'.$w.'">';

    return $output;
}

add_shortcode('act_logo_dark', 'act_logo_dark');
function act_logo_dark($atts){

    extract(shortcode_atts(array(
        'w' => '300',
    ), $atts));

    $logo = get_field('company_logo_dark', 'options');
    $output = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" width="'.$w.'">';

    return $output;
}
add_shortcode('act_menu', 'act_shortcode_wp_nav_menu');
function act_shortcode_wp_nav_menu($atts) {
    // Define default attributes and merge with user-provided attributes
    $atts = shortcode_atts(array(
        'name' => 'Social', // Default menu name
        'menu_class' => '', // Default to no class
        'class' => '' // Default to no class
    ), $atts);

    // Get the menu name and CSS class from the shortcode attributes
    $menu_name = $atts['name'];
    $menu_class = $atts['menu_class'];
    $container_class = $atts['class'];

    // Generate the menu
    $menu = wp_nav_menu(array(
        'menu' => $menu_name,
        'menu_class' => $menu_class, // Add the CSS class here
        'container_class' => $container_class, // Add the CSS class here
        'echo' => false
    ));

    // Check if the menu is not empty
    if (!empty($menu)) {
        return $menu; // Return the menu HTML
    } else {
        return '<p>Menu not found: ' . esc_html($menu_name) . '</p>'; // Optional error message
    }
}


add_shortcode('act_svg_icon', 'act_shortcode_svg_icon');
function act_shortcode_svg_icon($atts, $content = null) {
    extract(shortcode_atts(array('icon' => null), $atts));
    $icon = isset($icon)? $icon : $atts[0];
    $output = '';
    $output .= '<span class="o-svg-icon--'.$icon.'">';
    $output .= '<svg class="o-svg-icon__svg--'.$icon.'">';
    $output .= '<use xlink:href="#icon-'.$icon.'"></use>';
    $output .= '</svg>';
    $output .= '</span>';
    return $output;
}

add_shortcode('act_btn', 'act_shortcode_btn');
function act_shortcode_btn($atts, $content){

    $a = shortcode_atts(array(
        'label' => 'Click',
        'type' => '',
        'url' => '/',
        'class' => '',
        'icon' => ''
    ), $atts);

    $a['icon'] = ($a['icon']) ? 'icon-' . $a['icon'] : '';
    $mod_class = ($atts['type']) ? '--'.$atts['type'] : '';

    $btnClass = $a['class'] . " c-btn" . $mod_class ;

    $btnIcon = "";

    if($a['icon'])
    {
        $btnIcon = <<<HTML
<span class="c-btn__icon" >
    <span class="c-svg-icon c-svg-icon--{$a['icon']}">
        <svg class="c-svg-icon__svg--{$a['icon']}">
            <use xlink:href="#{$a['icon']}"></use>
        </svg>
    </span>
</span>
HTML;

    }


    $output = '';

    $output .= '<div class="'.$btnClass.'">';
    $output .= '<a class="c-btn__link'. $mod_class. '" href="'.$a['url'].'">';
    $output .= $btnIcon;
    $output .= '<span class="c-btn__label">';
    $output .= $a['label'];
    $output .= '</span>';
    $output .= '</a>';
    $output .= '</div>';

    return $output;
}

add_shortcode('act_cta', 'act_shortcode_cta');
function act_shortcode_cta($atts, $content){
    $a = shortcode_atts(array(
        'title' => '',
        'text' => '',
        'btn1' => 'Submit',
        'btn2' => 'Submit',
        'class' => '',
        'class1' => 'c-btn--cta ',
        'class2' => 'c-btn--secondary',
        'url1' => '',
        'url2' => ''
    ), $atts);

    extract($a);

    $a['text'] = '<p>'.$a['text'].'</p>';


    $output = '<div class="c-cta '.$class.'">';
    $output .= '<div class="c-cta__header">';
    $output .= '<header class="c-header--cta">';
    $output .= '<h4 class="c-header__heading--cta">';
    $output .= '<span class="c-header__title--cta">'.$a['title'].'</span>';
    $output .= '</h4>';
    $output .= '</header>';
    $output .= '</div>';
    $output .= '<div class="c-cta__content">';
    $output .= $a['text'];
    $output .= $content;
    $output .= '</div>';
    $output .= '<div class="c-cta__footer">';
    $output .= '<div class="c-btn-group">';
    if ($a['url1'] != '') {

        $output .= '<div class=" '.$class1.' ">';
        $output .= '<a class="c-btn__link--cta" href="'.$a['url1'].'">'.$a['btn1'].'</a>';
        $output .= '</div>';

    };
    if ($a['url2'] != '') {

        $output .= '<div class=" '.$class2.' ">';
        $output .= '<a class="c-btn__link--secondary" href="'.$a['url2'].'">'.$a['btn2'].'</a>';
        $output .= '</div>';

    };
    $output .= '</div>';

    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode('act_band', 'act_shortcode_band');
function act_shortcode_band($atts, $content){
    $a = shortcode_atts(array(
        'col' => '#fff',
        'bgc' => '#000',
        'text' => ''
    ), $atts);

    extract($a);
    $bob_class = "u-bob";

    // Check if it starts with '#' and is a potential hex
    if (strpos($bgc, '#') === 0 && ctype_xdigit(ltrim($variable, '#'))) {
        // It's a hexadecimal string (with '#')
        // Do something for hexadecimal
    } elseif (filter_var($bgc, FILTER_VALIDATE_INT) !== false && $bgc > 0) {
        // It's a positive integer
        // Do something for positive integer
        $bob_class .= '-'.$bgc;
    } else {
        // Default action
    }

    $output = '';

    $output .= '<div class="'.$bob_class.'">';
    $output .= '<div class="u-pt u-pb" >';
    $output .= $content;
    $output .= '</div>';
    $output .= '</div>';


    return $output;
}




