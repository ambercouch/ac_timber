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
        'row' => '',
        'type' => 'item'
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
            $contact_link = '<a href="mailto:'.$contact_value.'">'.$contact_value.'</a>';
            break;
        case 'tel':
            $contact_link = '<a href="tel:'.$contact_value.'">'.$contact_value.'</a>';
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
            $output .= $contact_label;
            $output .= ' : ';
            $output .= $contact_link;
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
function act_address_schema(){

    $company_name = get_field('company_name', 'options');
    $street_address = get_field('street_address', 'options');
    $address_locality = get_field('address_locality', 'options');
    $city = get_field('city', 'options');
    $postcode = get_field('postcode', 'options');

    $output = '';
    $output .= '<div class="c-company-details">';
    $output .= '<div class="c-company-details__company" itemscope itemtype="http://schema.org/LocalBusiness">';
    if ($company_name != ''){
        $output .= '<h1 class="c-company-details__heading">';
        $output .= '<span class="c-company-details__name" itemprop="name">'.$company_name.'</span>';
        $output .= '</h1>';
    }
    $output .= '<div class="c-company-details__address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
    if ($street_address != ''){
        $output .= '<span class="c-company-details__address-street" itemprop="streetAddress">'.$street_address.'</span>';
    }
    if ($address_locality != ''){
        $output .= '<span class="c-company-details__address-locality" itemprop="addressLocality">'.$address_locality.'</span>';
    }
    if ($city != ''){
        $output .= '<span class="c-company-details__address-region" itemprop="addressRegion">'.$city.'</span>';
    }
    if ($postcode != ''){
        $output .= '<span class="c-company-details__address-postcode" itemprop="postalCode">'.$postcode .'</span>';
    }
    $output .= ' </div><!-- itemprop="address" -->';
    $output .= '</div><!-- itemtype="http://schema.org/LocalBusiness" -->';
    $output .= '</div><!-- .c-company-address -->';


    return $output;
}