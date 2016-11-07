<?php

class Ac_Custom_Loop extends WP_Widget
{

    public function __construct()
    {

        parent::__construct('ac_custom_loop', // Base ID
            'Custom Loop', // Name
            array('description' => __('Custom loops', 'ambercouch'),) // Args
        );
    }

    public function form($instance)
    {
        if (isset($instance['title']))
        {
            $title = $instance['title'];
        } else
        {
            $title = __('New title', 'ambercouch');
        }
        if (isset($instance['post_type']))
        {
            $post_type = $instance['post_type'];
        } else
        {
            $post_type = __('', 'ambercouch');
        }
        if (isset($instance['show']))
        {
            $show = $instance['show'];
        } else
        {
            $show = __('1', 'ambercouch');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" type="text" value="<?php echo esc_attr($post_type); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Number of posts to show:') ?></label>
            <input id="<?php echo $this->get_field_id('show'); ?>" type="text" size="3" value="<?php echo esc_attr($show); ?>" name="<?php echo $this->get_field_name('show'); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        $instance['show'] = strip_tags($new_instance['show']);

        return $instance;
    }

    public function widget($args, $instance)
    {

        extract($args);
        global $wp_query;
        $temp_q = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query(array(
                $tax => $cat,
                'post_type' => $instance['post_type'],
                'showposts' => $instance['show'],
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
        echo $before_widget;
        echo $before_title;
        echo $instance['title'];
        echo $after_title;
        if (have_posts()) :
            ?>
            <ul class="<?php echo $instance['post_type'] ?>-list">
                <?php while (have_posts()): the_post(); ?>

                    <?php get_template_part('content', $instance['post_type']) ?>

                <?php endwhile; ?>
            </ul>
            <?php
        endif;
        echo $after_widget;
        $wp_query = $temp_q;
    }

}

register_widget('Ac_Custom_Loop');

class Act_Tax_Link extends WP_Widget
{

    public function __construct()
    {

        parent::__construct('act_tax_info', // Base ID
            'Term Link', // Name
            array('description' => __('Displays the content in a taxonomy term.', 'act'),) // Args
        );
    }

    public function form($instance)
    {
        
        if (isset($instance['tax_term']))
        {
            $tax_term = $instance['tax_term'];
        } else
        {
            $tax_term = __('', 'act');
        }

        $terms = get_terms(array(
            'taxonomy' => 'service_category',
            'hide_empty' => false,
        ));

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('tax_term'); ?>"><?php _e('Taxonomy Term:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('tax_term'); ?>" name="<?php echo $this->get_field_name('tax_term'); ?>">
                <?php foreach ($terms as $term) : ?>
                    <option <?php echo ($tax_term == $term->term_id) ? 'selected' : 'test' ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['tax_term'] = strip_tags($new_instance['tax_term']);
        return $instance;
    }

    public function widget($args, $instance)
    {

        extract($args);

        $term = get_term($instance['tax_term'], 'service_category');
        $term_link = get_term_link($term->term_id, $term->taxonomy);

        $icon = get_field('category_icon', 'service_category_4');

        echo $before_widget;

        ?>

        <div class="widget_act_tax_info__term">
            <div class="widget_act_tax_info__body">
                <div class="widget_act_tax_info__image">
                    <img src="<?php echo $icon['url'] ?>" alt="<?php echo ($icon['alt'] == '') ? $term->name : $icon['alt'] ?>" class="widget_act_tax_info__img">
                </div>
                <div class="widget_act_tax_info__title">
                    <h4 class="widget_act_tax_info__heading">
                        <?php echo $term->name; ?>
                    </h4>
                </div>
                <div class="widget_act_tax_info__description">
                    <?php echo wpautop($term->description); ?>
                </div>
            </div>
            <div class="widget_act_tax_info__footer">
                <ul class="widget_act_tax_info__menu">
                    <li class="widget_act_tax_info__menu-item"><a class="widget_act_tax_info__menu-link--more" href="<?php echo $term_link; ?>">Find Out More</a></li>
                    <li class="widget_act_tax_info__menu-item"><a class="widget_act_tax_info__menu-link--contact" href="/contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <?php
        echo $after_widget;

    }

}

register_widget('Act_Tax_Link');

class Act_Company_Address extends WP_Widget
{

    public function __construct()
    {

        parent::__construct('act_company_address', // Base ID
            'Company Address', // Name
            array('description' => __('Displays company address from the site options.', 'act'),)
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

register_widget('Act_Company_Address');
