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

    $logo = get_field('company_logo_colour', 'options');
    $output = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" width="'.$w.'">';

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


add_shortcode('act_cta', 'act_shortcode_cta');
function act_shortcode_cta($atts, $content = null) {
    extract(shortcode_atts(
        array(
            'title' => '',
            'sub_title' => '',
            'url' => '',
            'button_text' => 'Find Out More'),
        $atts));

    $title_markup = '';
    $sub_title_markup = '';
    $header_markup = '';
    $sub_title_class = '';
    $button_markup = '';
    $icon_markup = '';



    if ($title != ''){
        $title_markup .= '<h2 class="c-header__heading--cta">';
        $title_markup .= $title;
        $title_markup .= '</h2>';
    }

    if ($sub_title != ''){
        $sub_title_class = 'has-sub-heading';
        $sub_title_markup .= '<h3 class="c-header__heading--sub-heading-cta">';
        $sub_title_markup .= $sub_title;
        $sub_title_markup .= '</h3>';
    }else{
        $sub_title_markup = '<!-- no sub title -->';
    }
    if ($title_markup != '' || $sub_title_markup != ''){
        $header_markup .= '<header class="c-header--cta '.$sub_title_class.' ">';
        $header_markup .= $title_markup;
        $header_markup .= $sub_title_markup;
        $header_markup .= '</header>';
    }

    if ($url != ''){
        $icon_markup .= '<div class="c-svg-icon--arrow-right u-col-w">';
        $icon_markup .= '<svg role="img" preserveAspectRatio="none" class="c-svg-icon__svg">';
        $icon_markup .= '<use xlink:href="#icon-arrow-right" >';
        $icon_markup .= '</svg>';
        $icon_markup .= '</div>';

        $button_markup .= '<footer class="c-cta__footer">';
        $button_markup .= '<div class="c-cta__btn">';
        $button_markup .= '<a class="o-btn c-btn--ghost c-btn--icon" href="'.$url.'">';
        $button_markup .= '<span class="c-btn__label">';
        $button_markup .= $button_text;
        $button_markup .= '</span>';
        $button_markup .= '<span class="c-btn__icon">';
        $button_markup .= $icon_markup;
        $button_markup .= '</span>';
        $button_markup .= '</a>';
        $button_markup .= '</div>';
        $button_markup .= '</footer>';
    }

    //$title_markup = $title;

    $output = '';
    $output .= '<div class="c-cta o-box u-bgc-2 u-col-w u-tac">';
    $output .= '<div class="c-cta__header">';
    $output .= $header_markup;
    $output .= '</div>';
    $output .= '<div class="c-cta__body">';
    $output .= wpautop($content);
    $output .= '</div>';
    $output .= $button_markup;
    $output .= '</div>';

    return $output;
}

add_shortcode('act_page_sections', 'act_shortcode_page_sections');
function act_shortcode_page_sections($atts, $content = null)
{

    $sections = get_field('page_section');


    $output = 'Page Sections 2';
    $output = '<div class="l-page-sections" >';

    if (have_rows('page_section')):
        while( have_rows('page_section') ): the_row();



            $section_title = get_sub_field('section_title');
            $section_title_markup = '';
            $section_sub_title = get_sub_field('section_sub_title');
            $section_sub_title_markup = '';
            $section_content = get_sub_field('section_content');
            $section_image = get_sub_field('section_image');
            $section_image_markup = '';

            if($section_sub_title != ''){
                $section_sub_title_markup .= '<h3 class="c-header__heading--sub-heading-section">';
                $section_sub_title_markup .=  $section_sub_title;
                $section_sub_title_markup .= '</h3>';
            }

            if( $section_title != ''){
                $section_title_markup .= '<header class="c-header--section has-sub-heading">';
                $section_title_markup .= '<h2 class="c-header__heading--section">';
                $section_title_markup .= $section_title;
                $section_title_markup .= '</h2>';
                $section_title_markup .= $section_sub_title_markup;
                $section_title_markup .= '</header>';
            }

            if( $section_image != ''){
                $image_srcset = wp_get_attachment_image_srcset($section_image['ID']);
                $image_src = wp_get_attachment_image_url($section_image['ID']);
                $image_sizes = wp_get_attachment_image_sizes($section_image['ID'], 'large');


                $section_image_markup .= '<div class="c-feature-image--section">';
                $section_image_markup .= '<img src="'.$image_src.'"  class="c-feature-image__img" srcset="'.$image_srcset.'" sizes="'.$image_sizes.'"  alt="'.$section_title.'">';
                $section_image_markup .= '</div>';
            }

            $output .= '<div class="l-page-sections__page-section">';
            $output .= '<div class="c-page-section">';
            $output .= '<div class="c-page-section__feature-image">';
            $output .= $section_image_markup;
            $output .= '</div>';
            $output .= '<div class="c-page-section__content">';
            $output .= $section_title_markup;
            $output .= '<div class="c-page-section__body">';

            $output .= $section_content;

            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
    endWhile;
        endif;

        $output .="<div>";

    return $output;
}
