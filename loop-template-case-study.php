<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

$handle = 'ac_wp_custom_loop_styles';
$list = 'enqueued';
$features = get_field('case_study_feature_list');

if (! wp_script_is( $handle, $list )) {
    wp_register_style( 'ac_wp_custom_loop_styles', plugin_dir_url( __FILE__ ) . 'assets/css/ac_wp_custom_loop_styles.css', array(), '20181007' );
    wp_enqueue_style( 'ac_wp_custom_loop_styles' );
}
?>
<li class="l-thumb-list__item" >
    <article id="post-<?php the_ID(); ?>" <?php post_class('l-thumb-list__post-thumb ahb-test-item'); ?>>
      <div class="c-post-thumb">
        <?php if ( '' !== get_the_post_thumbnail() ) : ?>
          <div class="post-thumbnail c-post-thumb__feature-image--case-study">

                <?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>

          </div><!-- .post-thumbnail -->
        <?php endif; ?>

        <?php if (has_excerpt()) : ?>
          <div class="c-post-thumb__excerpt"  >
            <?php the_excerpt() ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($features)) : ?>
        <ul class="c-post-thumb__list">
            <?php foreach($features as $feature) : ?>
                <li class="c-post-thumb__item"><?php echo $feature['feature_list_feature'] ?></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
        <?php //var_dump($features)?>
      </div>
    </article>
</li>
