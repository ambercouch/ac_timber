<?php
/** Template Name: List Page
 *
 * @package WordPress
 * @subpackage ac_timber
 */

$context = Timber::get_context();

/**  save the wordpress post **/
$WPPost = $post;


$post = new TimberPost();
$context['post'] = $post;

$context['template'] = 'list-page';
$context['postType'] = 'page';

$context['primary_widgets'] = Timber::get_widgets('Primary');
$context['footer_widgets'] = Timber::get_widgets('Footer');
$context['main_mod'] = '--list-page';
$templates = array( 'page-' . $post->post_name . '.twig', 'page.twig' );
if ( is_front_page() ) {
    array_unshift( $templates, 'front-page.twig' );
}

//get childlist
$children = false;

if(!$WPPost->post_parent){
    $args = array(
      'title_li' => '',
      'child_of' => $post->ID,
      'echo' => 0,
    );
    $children = wp_list_pages($args);
}else{
    if($WPPost->ancestors)
    {
        $ancestors = $WPPost->ancestors[sizeof($WPPost->ancestors) - 1];
        $args = array(
            'title_li' => '',
            'child_of' => $ancestors,
            'echo' => 0,
        );
        $children = wp_list_pages($args);
        $parentId = ($ancestors == 11)? '158' : $ancestors;
        $context['parentId'] = $parentId    ;
        $parent_link = get_permalink($parentId);
        $context['parentLink'] = $parent_link;
    }
}

$context['childList'] = $children;

//Ancestor Logic
if( is_page() && $post->post_parent > 0 ) {
    $children = get_pages('child_of='.$post->ID);
    if( count( $children ) != 0 ) {
        //Has Child
    }
    $parent = get_post_ancestors($post->ID);

    if( count( $children ) <= 0  && empty($parent[1]) ) {
        // Is child

    } elseif ( count( $children ) <= 0  && !empty($parent[1]) )  {
        // Is child of child
    }
} else {
    //Barren Orphan :(
}


if ( post_password_required( $post->ID ) ) {
    Timber::render( 'single-password.twig', $context );
} else {
    Timber::render( $templates, $context );
}