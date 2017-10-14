<?php

// update the default comment form fields
add_filter( 'comment_form_default_fields', 'act_comment_form_fields' );
function act_comment_form_fields( $fields ) {
    $fields   =  array(
        'author' => '<div class="comment-respond__author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',
        'email'  => '<div class="comment-respond__email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
        'url'    => '<div class="comment-respond__url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
        'cancel_reply_before'  => ' <small class="comment-respond__cancel-reply">',
        'cancel_reply_after'   => '</small>'
    );
    return $fields;
}

//Update the comment_form_defaults
add_filter( 'comment_form_defaults', 'act_comment_form_defaults' );
function act_comment_form_defaults( $defaults ) {
    $defaults   =  array(
        'cancel_reply_before'  => ' <small class="comment-respond__cancel-reply">', //Added class cancel wrapper
        'cancel_reply_after'   => '</small>'
    );
    return $defaults;
}

//Update cancel_comment_reply_link
add_filter( 'cancel_comment_reply_link', 'act_cancel_comment_reply_link');
function act_cancel_comment_reply_link( $formatted_link ){
    //Add class to cancel-reply-link
    $formatted_link = '<a class="comment__cancel-reply-link" rel="nofollow" id="cancel-comment-reply-link" href="' . $link . '"' . $style . '>' . $text . '</a>';
    return $formatted_link;
}

// $args for comment_list
$args = array(
    'walker'            => New Ac_Walker_Comment, //new walker to just update the comment template
    'max_depth'         => '2', //set depth to 2 for only 1 reply deep
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
    'echo'              => false // don't echo the form as we will store it in the twig context var
);
// $args for comment_list passed to twig
$context['comment_list'] = wp_list_comments($args, get_comments(array('post_id' => $post->ID)));

// $args for comment_form()
$args = array(
    'comment_field'        => '<div class="comment-respond__comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="4"  aria-required="true" required="required"></textarea></div>',
    /** This filter is documented in wp-includes/link-template.php */
    'must_log_in'          => '<div class="comment-respond__log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',
    /** This filter is documented in wp-includes/link-template.php */
    'logged_in_as'         => '<div class="comment-respond__logged-in">' . sprintf( __( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a>. <a href="%3$s">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</div>',
    'comment_notes_before' => '<div class="comment-respond__notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span> </div>',
    'comment_notes_after'  => '',
    'class_form'           => 'comment-respond__form',
    'class_submit'         => 'comment-respond__submit',
    'title_reply'          => '',
    'title_reply_to'       => __( 'Leave a Reply to %s' ),
    'title_reply_before'   => '',
    'title_reply_after'    => '',
    'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'submit_field'         => '<div class="comment-respond__submit-wrapper">%1$s %2$s</div>',
    'format'               => 'html5',
);
// $args for comment_form() passed to twig templates
$context['comment_form_args'] = $args;
