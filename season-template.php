<?php
// season-template.php
global $post;

if (isset($post) && $post->post_type === 'season') : ?>
  <h2><?php the_title(); ?>
    <?php if (current_user_can('edit_post', $post->ID)) : ?>
      <small class="c-admin-link"><a class="c-admin-link__link" href="<?php echo get_edit_post_link($post->ID); ?>">Edit Season</a></small>
    <?php endif; ?>
  </h2>
  <div class="season-content">
      <?php echo wpautop(get_the_content()); ?>
  </div>
    <?php $season_content = get_field('season_content');
    if ($season_content) : ?>
    <div class="l-post-thumb-list--season">
      <ul class="l-post-thumb-list__list--season">
          <?php foreach ($season_content as $related_post) : ?>
            <li class="l-post-thumb-list__item--season">
              <div class="l-post-thumb-list__post-thumb--season">
                <div class="c-post-thumb--season-item">

                <?php if (has_post_thumbnail($related_post->ID)) : ?>
                  <div class="c-post-thumb__feature-image--season-item">
                  <div class="c-feature-image--season-item">
                    <a class="c-feature-image__link--season-item" href="<?php echo get_permalink($related_post->ID); ?>">
                        <?php echo get_the_post_thumbnail($related_post->ID, 'thumbnail'); ?>
                    </a>
                  </div>
                  </div>
                <?php endif; ?>

                  <div class="c-post-thumb__body--season-item">

                  <div class="c-post-thumb__header--season-item">
                    <header class="c-header--season-item">
                    <h3 class="c-header__heading--season-item">
                    <a class="c-header__link--season-item" href="<?php echo get_permalink($related_post->ID); ?>">
                        <?php echo get_the_title($related_post->ID); ?>
                    </a>
                    </h3>
                    <div class="c-header__meta">
                        <?php
                        $post_type = get_post_type($related_post->ID);
                        if ($post_type === 'sfwd-courses') : ?>
                        <div class="c-badge--course">
                          Course
                        </div>
                        <?php elseif ($post_type === 'post') :
                            $post_format = get_post_format($related_post->ID);
                            if ($post_format === 'video') : ?>
                      <div class="c-badge--video">
                              Video
                            <?php else : ?>
                        <div class="c-badge--article">
                              Article
                        </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                  </div>
                    </header>
                      <?php
                  $excerpt = get_the_excerpt($related_post->ID);
                  if ($excerpt) : ?>
                    <div class="c-post-thumb__content--season-item">
                        <?php echo $excerpt; ?>
                    </div>
                  <?php endif; ?>
                  <div class="c-post-thumb__footer--season-item">
                    <?php if (current_user_can('edit_post', $related_post->ID)) : ?>
                      <a class="c-admin-link__link" href="<?php echo get_edit_post_link($related_post->ID); ?>">Edit</a>
                    <?php endif; ?>
                  </div>
              </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
      </ul>
    </div>
    <?php else : ?>
      <p>There is no content for this season</p>
    <?php
    endif;
endif;
?>
