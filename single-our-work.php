<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 31/05/2016
 * Time: 11:16
 */


$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['template_class'] = '--our-work';


$templates = array( 'our-work.twig' , 'single.twig');

Timber::render( $templates, $context );