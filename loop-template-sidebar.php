<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

$excerpt = false;


$handle = 'ac_wp_custom_loop_styles';
$list = 'enqueued';

if (! wp_script_is( $handle, $list )) {
    wp_register_style( 'ac_wp_custom_loop_styles', plugin_dir_url( __FILE__ ) . 'assets/css/ac_wp_custom_loop_styles.css', array(), '20181007' );
    wp_enqueue_style( 'ac_wp_custom_loop_styles' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('l-post-thumb-list__item--post-thumb-sidebar'); ?>>
  <div class="c-post-thumb--sidebar">
    <header  class="c-post-thumb__header">
      <h2 class="c-post-thumb__heading--sidebar">
             <span class="c-post-thumb__title">
             <a href="<?php echo esc_url( get_permalink() ) ?>" class="c-post-thumb__link--title" rel="bookmark">
               <span class="c-post-thumb__link-title"><?php the_title() ?></span>
             </a>
               </span>
      </h2>
    </header>
    <?php if ( '' !== get_the_post_thumbnail() ) : ?>
      <div class="c-post-thumb__feature-image">
        <a href="<?php the_permalink(); ?>" class="c-post-thumb__link--image" >
            <?php the_post_thumbnail('post-thumbnail'); ?>
        </a>
      </div><!-- .post-thumbnail -->
    <?php endif; ?>


      <div class="c-post-thumb__excerpt--sidebar"  >
        <?php echo get_the_excerpt() ?>
      </div>

  </div>
</article>
