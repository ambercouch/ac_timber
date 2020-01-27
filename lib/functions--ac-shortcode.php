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
            $output .= '</span">';
            $output .= '<span class="c-company-contact-item__sep"> : </span>';
            $output .= '<span class="c-company-contact-item__value">';
            $output .= $contact_link;
            $output .= '</span">';
            $output .= '</div>';
            break;
        case 'value':
            $output .= $contact_value;
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

    $logo = get_field('company_logo_colour', 'options');
    $output = '<img src="'.$logo['url'].'" src="'.$logo['alt'].'" width="'.$w.'">';

    return $output;
}

add_shortcode('act_logo_light', 'act_logo_light');
function act_logo_light($atts){

    extract(shortcode_atts(array(
        'w' => '300',
    ), $atts));

    $logo = get_field('company_logo_light', 'options');
    $output = '<img src="'.$logo['url'].'" src="'.$logo['alt'].'" width="'.$w.'">';

    return $output;
}

add_shortcode('act_logo_dark', 'act_logo_dark');
function act_logo_dark($atts){

    extract(shortcode_atts(array(
        'w' => '300',
    ), $atts));

    $logo = get_field('company_logo_dark', 'options');
    $output = '<img src="'.$logo['url'].'" src="'.$logo['alt'].'" width="'.$w.'">';

    return $output;
}

add_shortcode('act_menu', 'act_shortcode_wp_nav_menu');
function act_shortcode_wp_nav_menu($atts, $content = null) {
    extract(shortcode_atts(array('name' => null), $atts));
    $name = isset($name)? $name : $atts[0];
    return wp_nav_menu(array('menu' => $name, 'echo' => false));
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

add_shortcode('act_cta', 'act_shortcode_call_to_action');
function act_shortcode_call_to_action($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'We Would Love to Hear From You!',
        'linktext' => 'Contact Us',
        'linkid' => null
        ), $atts));

    $htmlLink = '';
    if ($linkid){
        $htmlLink .= '<div class="c-cta__btn">';
        $htmlLink .= '<a class="c-btn--cta" href="'.get_permalink($linkid).'" >';
        $htmlLink .= $linktext;
        $htmlLink .= '</a>';
        $htmlLink .= '</div>';
    }

    $output = '';
    $output .= '<div class="c-cta">';
    $output .= '<header class="c-cta__header">';
    $output .= '<h3 class="c-cta__heading">';
    $output .= '<span class="c-cta__title">';
    $output .= $title;
    $output .= '</span>';
    $output .= '</h3>';
    $output .= '</header>';
    $output .= '<div class="c-cta__body">';

    $output .= '<div class="c-cta__content" >';
    $output .= wpautop($content);
    $output .= '</div>';

    $output .= $htmlLink;
    
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}


