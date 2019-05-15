<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

?>
<?php $post_image = get_field('service_icon') ?>
<?php $cite_name  = ( get_field('citation_name') != "" )?  get_field('citation_name') : get_the_title() ; ?>
<?php $cite_info = get_field('citation_info') ?>

<blockquote id="post-<?php the_ID(); ?>" <?php post_class('l-testimonial-thumb-list__testimonial-thumb'); ?>>
  <div class="c-testimonial-thumb">
    <div class="c-testimonial-thumb__wrapper">
      <?php if ( '' !== get_the_post_thumbnail() ) : ?>
        <div class="post-thumbnail c-testimonial-thumb__feature-image">
              <?php the_post_thumbnail( 'feature500' ); ?>
        </div><!-- .post-thumbnail -->
      <?php endif; ?>
      <div class="c-svg-icon--testimonial-quote">
      <svg preserveAspectRatio="none" class="c-svg-icon__svg--testimonial-quote">
        <use class="c-svg-icon__use" xlink:href="#icon-quote-left"></use>
      </svg>
      </div>
    <div class="c-testimonial-thumb__excerpt">
      <?php the_excerpt() ?>
    </div>
    </div>
    <div class="c-testimonial-thumb__cite">
      <h6 class="c-testimonial-thumb__cite-heading"><?php echo $cite_name;?></h6>
      <?php if ($cite_info != '' ) : ?>
      <span class="c-testimonial-thumb__cite-info"><?php echo $cite_info; ?> </span>
      <?php endif; ?>
    </div>
  </div>
</blockquote>