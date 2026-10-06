<?php

class Act_Company_Address extends WP_Widget
{

    public function __construct()
    {

        parent::__construct('act_company_address', // Base ID
            'Company Address', // Name
            array('description' => __('Displays company address from the site options.', '_act'),)
        );
    }

    public function form($instance)
    {
        ?>
        <p>No settings required.</p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {

    }

    public function widget($args, $instance)
    {

        extract($args);

        $company = [];
        (get_field('company_name', 'option') != '') ? $company['company_name'] = get_field('company_name', 'option') : '';
        (get_field('street_address', 'option') != '') ? $company['address']['street_address'] = get_field('street_address', 'option') : '';
        (get_field('address_locality', 'option') != '') ? $company['address']['address_locality'] = get_field('address_locality', 'option') : '';
        (get_field('city', 'option') != '') ? $company['address']['city'] = get_field('city', 'option') : '';
        (get_field('postcode', 'option') != '') ? $company['address']['postcode'] = get_field('postcode', 'option') : '';

        if(empty($company)){
            return;
        }



        $output = '';
        $output .= $before_widget;
        $output .= '<div class="widget_act_company_address__container">';
        $output .= '<div class="widget_act_company_address__company" itemscope itemtype="http://schema.org/LocalBusiness">';
        if(isset($company['company_name']))
        {
            $output .= '<span class="widget_act_company_address__company-name" itemprop="name">';
            $output .= $company['company_name'];
            $output .= ' </span><!-- .act_company_address__company-name -->';
        }
        if(isset($company['address']))
        {
            $output .= '<div class="widget_act_company_address__company-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';

            if(isset($company['address']['street_address']))
            {
                $output .= '<span class="widget_act_company_address__street-address" itemprop="streetAddress">';
                $output .= $company['address']['street_address'];
                $output .= ' </span>';
            }

            if(isset($company['address']['address_locality']))
            {
                $output .= '<span class="widget_act_company_address__locality" itemprop="addressLocality">';
                $output .= $company['address']['address_locality'];
                $output .= ' </span>';
            }

            if(isset($company['address']['city']))
            {
                $output .= '<span class="widget_act_company_address__city" itemprop="addressRegion">';
                $output .= $company['address']['city'];
                $output .= ' </span>';
            }

            if(isset($company['address']['postcode']))
            {
                $output .= '<span class="widget_act_company_address__postcode itemprop="postalCode">';
                $output .= $company['address']['postcode'];
                $output .= ' </span>';
            }

            $output .= '</div><!-- .act_company_address__company-address -->';
        }

        $output .= '</div><!-- .act_company_address__company -->';
        $output .= '</div><!-- .act_company_address__container -->';
        $output .= $after_widget;

        echo $output;

    }

}

function act_register_company_address_widget() {
    register_widget( 'Act_Company_Address' );
}

add_action( 'widgets_init', 'act_register_company_address_widget' );
