<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

?>
<?php $post_icon = get_field('service_icon'); ?>
<?php $hide_content_link = get_field('hide_service_content_link'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('l-post-thumb-list__post-thumb'); ?>>
  <div class="c-post-thumb--service">
    <?php if ( '' != $post_icon ) : ?>
      <div class="post-thumbnail c-post-thumb__post-icon--service">
        <?php if ( $hide_content_link != true ) : ?>
        <a href="<?php the_permalink(); ?>" class="c-post-thumb__post-icon-link--service" >
           <img class="c-post-thumb__post-icon-img--service" src="<?php echo $post_icon['sizes']['feature500']; ?>" alt="<?php echo ($post_icon["alt"] != "" ) ? $post_icon["alt"] : get_the_title()." Icon";  ?>" />
        </a>
        <?php else : ?>
          <img class="c-post-thumb__post-icon-img--service" src="<?php echo $post_icon['sizes']['feature500']; ?>" alt="<?php echo ($post_icon["alt"] != "" ) ? $post_icon["alt"] : get_the_title()." Icon";  ?>" />
        <?php endif ?>
      </div><!-- .post-thumbnail -->
    <?php endif; ?>
         <header  class="entry-header c-post-thumb__header--service">
           <h2 class="entry-title c-post-thumb__heading--service">
               <?php if ( $hide_content_link != true ) : ?>
             <a href="<?php the_permalink(); ?>" class="c-post-thumb__link" rel="bookmark">
               <span class="c-post-thumb__link-title--service"><?php the_title() ?></span>
             </a>
             <?php else : ?>
                 <span class="c-post-thumb__link-title--service"><?php the_title() ?></span>
               <?php endif ?>
           </h2>
         </header>
    <div class="c-post-thumb__excerpt--service">
      <?php the_excerpt() ?>
    </div>
      <?php if ( $hide_content_link != true ) : ?>
    <div class="c-post-thumb__more">
      <a class="c-post-thumb__more-link" href="<?php the_permalink(); ?>" >Learn More</a>
    </div>
    <?php endif; ?>
  </div>
</article>
