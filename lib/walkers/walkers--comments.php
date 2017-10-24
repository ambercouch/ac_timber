<?php
class Ac_Walker_Comment extends Walker_Comment {

    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'comments__item--parent' : 'comments__item--children', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="response">
            <footer class="response__meta">
                <div class="response__author vcard">
                    <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    <?php
                    /* translators: %s: comment author link */
                    printf( __( '%s <span class="says">says:</span>' ),
                        sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
                    );
                    ?>
                </div><!-- .comment-author -->

                <div class="response__metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            /* translators: 1: comment date, 2: comment time */
                            printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-metadata -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="response__awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                <?php endif; ?>
            </footer><!-- .comment-meta -->

            <div class="response__content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <?php
            comment_reply_link( array_merge( $args, array(
                'add_below' => 'div-comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<div class="response__reply-link">',
                'after'     => '</div>'
            ) ) );
            ?>
        </article><!-- .comment-body -->
        <?php
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="comments__list--children">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="comments__list--children">' . "\n";
                break;
        }
    }


}
