<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

?>
<?php $post_icon = get_field('company_logo') ?>
<?php $company_name= get_field('company_name') ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('l-post-thumb-list__post-thumb--case-study'); ?>>
  <div class="c-post-thumb--case-study">
      <?php if ( '' != $post_icon ) : ?>
        <div class="post-thumbnail c-post-thumb__post-icon">
          <a href="<?php the_permalink(); ?>" class="c-post-thumb__post-icon-link" >
            <img class="c-post-thumb__post-icon-img" src="<?php echo $post_icon['sizes']['serviceMenuMedium']; ?>" alt="<?php echo ($post_icon["alt"] != "" ) ? $post_icon["alt"] : get_the_title()." Icon";  ?>" />
          </a>
        </div><!-- .post-thumbnail -->
      <?php endif; ?>
    <header  class="entry-header c-post-thumb__header">
      <h2 class="entry-title c-post-thumb__heading">
        <a href="<?php the_permalink(); ?>" class="c-post-thumb__link" rel="bookmark">
          <span class="c-post-thumb__link-title"><?php echo $company_name; ?></span>
        </a>
      </h2>
    </header>
    <div class="c-post-thumb__excerpt--case-study">
        <?php the_excerpt() ?>
    </div>
    <div class="c-post-thumb__more--case-study">
      <a class="c-post-thumb__more-link--case-study" href="<?php the_permalink(); ?>" >Learn More</a>
    </div>
  </div>
</article>