<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

$excerpt = false;

if (has_excerpt()){
    $excerpt = get_the_excerpt();
}elseif (get_field('page_intro')){
  $excerpt = get_field('page_intro');
}

$handle = 'ac_wp_custom_loop_styles';
$list = 'enqueued';

if (! wp_script_is( $handle, $list )) {
    wp_register_style( 'ac_wp_custom_loop_styles', plugin_dir_url( __FILE__ ) . 'assets/css/ac_wp_custom_loop_styles.css', array(), '20181007' );
    wp_enqueue_style( 'ac_wp_custom_loop_styles' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('l-post-thumb-list__item--home-post'); ?>>
  <div class="c-post-thumb--home-post">
    <header  class="c-post-thumb__header">
      <h2 class="c-post-thumb__heading--home-post">
             <span class="c-post-thumb__title">
             <a href="<?php echo esc_url( get_permalink() ) ?>" class="c-post-thumb__link--title" rel="bookmark">
               <span class="c-post-thumb__link-title"><?php the_title() ?></span>
             </a>
               </span>
      </h2>
    </header>


      <div class="c-post-thumb__excerpt--home-post"  >
        <?php the_excerpt('...') ?>
      </div>

  </div>
</article>
