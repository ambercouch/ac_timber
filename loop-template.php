<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

$meta_price = (get_field('treatment_price') != '') ? '<span class="treatment-meta--price"><span class="treatment-meta__denom">£</span><span class="treatment-meta__price">'.get_field('treatment_price').'</span></span>' : '';
$meta_duration = get_field('treatment_duration') ? '<span class="treatment-meta--duration"><span class="treatment-meta__duration"><span>Time : </span>'.get_field('treatment_price').'</span> <span class="treatment-meta__units">min</span></span>' : '';
$meta_text = ($meta_price != '' && $meta_duration != '') ? $meta_duration.'<span class="sep"> | </span>'.$meta_price : $meta_price.$meta_duration;
?>


  <li class="c-service-menu__item">
    <article id="post-<?php the_ID(); ?>" <?php post_class('c-service-menu__service-thumb'); ?>>
      <div class="c-service-thumb">
          <?php if ( '' !== get_the_post_thumbnail() ) : ?>
            <div class="c-service-menu-post-thumb__feature-image">
              <a href="" class="c-service-thumb__feature-image-link" >
                  <?php the_post_thumbnail( 'serviceMenuMedium', array('class' => 'c-service-thumb__img')); ?>
              </a>
            </div><!-- .post-thumbnail -->
          <?php endif; ?>
        <header  class="entry-header c-service-thumb__header">
          <h2 class="entry-title c-service-thumb__heading">
            <a href="<?php esc_url( get_permalink() ) ?>" class="c-service-thumb__link" rel="bookmark">
              <span class="c-service-thumb__link-title"><?php the_title() ?></span>
            </a>
          </h2>
        </header>
        <?php if ($meta_text != '') : ?>
        <div class="c-service-thumb__meta">
          <?php echo $meta_text ?>
        </div>
        <?php endif; ?>
        <div class="c-service-thumb__content">
          <?php the_excerpt() ?>
        </div>
      </div>
    </article>
  </li>

