<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */


$handle = 'ac_testimonial_styles';
$handle_js = 'ac_testimonial_script';
$list = 'enqueued';

$the_content = apply_filters('the_content', get_the_content());
$testimonial_title = (get_field('testimonial_title') != '') ? get_field('testimonial_title') : get_the_title() ;
$testimonial_intro = wpautop(get_field('testimonial_intro'));
$testimonial_cite = get_field('testimonial_citation');
$tesimonial_id = get_the_ID();

if (! wp_script_is( $handle_js, $list )) {
  wp_register_script( 'ac_testimonial_script', AC_PLUGIN_JS_URL . 'ac_testimonial_script.js', array('jquery'), '20200706' );
wp_enqueue_script( $handle_js );
}

if (! wp_script_is( $handle, $list )) {
wp_register_style( 'ac_testimonial_styles', AC_PLUGIN_CSS_URL . 'ac_wp_custom_loop_styles.css', array(), '20181007' );
wp_enqueue_style( 'ac_testimonial_styles' );
}
?>

<li class="l-testimonial-thumb-list__item">
    <?php if ( !empty($the_content) || $testimonial_intro != '' ) : ?>
      <div class="l-testimonial-thumb-list__ac-testimonial">
        <div class="c-ac-testimonial">
      <blockquote class="c-ac-testimonial__content">
        <div class="c-ac-testimonial__intro">
            <?php echo $testimonial_intro ?>
            <?php if ( !empty($the_content) ) : ?>
              <a class="c-ac-testimonial__link--read-more" href="#"  data-state="off" data-control="testimonial<?php echo $tesimonial_id ?>" > <span class="c-ac-testimonial__read-more-text" >Read More</span></a>
            <?php endif ?>
        </div>
          <?php if ( !empty($the_content) ) : ?>
            <div class="c-ac-testimonial__body" data-state="off" data-container="testimonial<?php echo $tesimonial_id ?>" >
                <?php the_content() ?>

            </div>
          <?php endif ?>
        <cite class="c-ac-testimonial__cite">
            <?php echo $testimonial_cite ?>
        </cite>
        <div class="c-ac-testimonial__footer">
          <a class="c-ac-testimonial__link--read-less" href="#" data-state="off" data-control="testimonial<?php echo $tesimonial_id ?>" > <span class="c-ac-testimonial__read-less-text" >Read Less</span></a>
        </div>
      </blockquote>
        </div>
      </div>
    <?php endif; ?>
</li>
