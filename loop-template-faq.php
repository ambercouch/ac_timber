<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

$faq_image = get_field('faq_image');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-faq-list__post-thumb'); ?>>
  <div class="c-post-thumb--faq">
         <header  class="entry-header c-post-thumb__header--faq" data-state="off" data-control="faq" >
           <h2 class="entry-title c-post-thumb__heading--faq">
             <span class="c-post-thumb__question"><?php the_title() ?></span>
             <span class="c-post-thumb__control-icons">
               <span class="c-post-thumb__control-expand control-expand" >+</span><span class="c-post-thumb__control-collaps control-collaps" >-</span>
             </span>
           </h2>
         </header>
    <div class="c-post-thumb__body" data-state="off"  data-container="faq" >
        <?php if ( '' !== get_the_post_thumbnail() ) : ?>
          <div class="post-thumbnail c-post-thumb__feature-image--faq">
            <a href="<?php the_permalink(); ?>" class="c-post-thumb__feature-image-link" >
                <?php the_post_thumbnail( 'feature16-9' ); ?>
            </a>
          </div><!-- .post-thumbnail -->
        <?php endif; ?>
      <div class="c-post-thumb__content" >
        <?php the_content() ?>
      </div>
    </div>
      <?php if ( current_user_can('editor') || current_user_can('administrator') ) :?>
        <div class="c-post-thumb__admin-helper">
          <?php edit_post_link('edit this faq'); ?>
        </div>
      <?php endif ?>

  </div>
</article>