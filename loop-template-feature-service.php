<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 07/10/2018
 * Time: 13:46
 */

?>
<?php $post_image = get_field('service_background_image') ?>
<?php $cite_name  = ( get_field('citation_name') != "" )?  get_field('citation_name') : get_the_title() ; ?>
<?php $cite_info = get_field('citation_info') ?>
<?php $post_excerpt = (get_field('service_intro_content') != "")? get_field('service_intro_content') : get_the_excerpt(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('l-post-thumb-list__post-thumb--feature-list'); ?>>
  <div class="c-post-thumb--feature-service" style="background: url('<?php echo $post_image['url'] ?>') no-repeat; background-size:cover;">
    <div class="c-post-thumb__wrapper--feature-list">

      <header  class="entry-header c-post-thumb__header--feature-list">
        <h2 class="entry-title c-post-thumb__heading--feature-list">
          <a href="<?php the_permalink(); ?>" class="c-post-thumb__link" rel="bookmark">
            <span class="c-post-thumb__link-title"><?php the_title() ?></span>
          </a>
        </h2>
      </header>

    <div class="c-post-thumb__excerpt--feature-list">
      <?php echo $post_excerpt ?>
    </div>

    <div class="c-post-thumb__more">
      <a class="c-post-thumb__more-link" href="<?php the_permalink(); ?>" >Learn More</a>
    </div>
    </div>
  </div>
</article>