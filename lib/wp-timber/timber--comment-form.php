<?php
$args = array(

    'comment_field'        => '<div class="comment-form__comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="4"  aria-required="true" required="required"></textarea></div>',
    /** This filter is documented in wp-includes/link-template.php */
    'must_log_in'          => '<div class="comment-form__log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',
    /** This filter is documented in wp-includes/link-template.php */
    'logged_in_as'         => '<div class="comment-form__logged-in">' . sprintf( __( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a>. <a href="%3$s">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</div>',
    'comment_notes_before' => '<div class="comment-form__notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span> </div>',
    'comment_notes_after'  => '',
    'class_form'           => 'comment-form__form',
    'class_submit'         => 'comment-form__submit',
    'title_reply'          => '',
    'title_reply_to'       => __( 'Leave a Reply to %s' ),
    'title_reply_before'   => '',
    'title_reply_after'    => '',
    'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'submit_field'         => '<div class="comment-form__submit-wrapper">%1$s %2$s</div>',
    'format'               => 'html5',

);

add_filter( 'comment_form_default_fields', 'wpsites_comment_form_fields' );

function wpsites_comment_form_fields( $fields ) {

    $fields   =  array(
        'author' => '<p class="comment-form__author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form__email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        'url'    => '<p class="comment-form__url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
    );

    return $fields;
}
$context['comment_form_args'] = $args;
$context['comment_form'] = TimberHelper::get_comment_form(null, $args);

$args = array(
    'walker'            => New Ac_Walker_Comment,
    'max_depth'         => '2',
    'style'             => 'ol',
    'callback'          => null,
    'end-callback'      => null,
    'type'              => 'all',
    'reply_text'        => 'Reply',
    'page'              => '',
    'per_page'          => '',
    'avatar_size'       => 100,
    'reverse_top_level' => null,
    'reverse_children'  => '',
    'format'            => 'html5',
    'short_ping'        => false,
    'echo'              => false
);
$context['comment_list'] = wp_list_comments($args, get_comments(array('post_id' => $post->ID)));
