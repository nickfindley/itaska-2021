<?php
/**
 * The template for displaying comments and the comment form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dutchtown
 * @subpackage Itaska
 * @since 0.1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>

<section class="comments" id="comments">
    <div class="comments-container">
        <h3 class="comments-title">
        <?php
        dutchtown_comment_count( array(
            'cap'		=> true,
            'phrase'	=> true,
            'after_phrase'	=> ' on &ldquo;' . get_the_title() . '&rdquo;'
            )
        );
        ?>
        </h3><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <?php
        wp_list_comments( array(
            'style'     	=> 'ol-article',
            'short_ping'	=> true,
            'type'			=> 'comment',
            'walker'		=> new Dutchtown_Walker_Comment
        ) );
        ?>

        <?php the_comments_navigation(); ?>

        <?php
        if ( ! comments_open() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dutchtown' ); ?></p>
        <?php endif; ?>
        ?>
    </div>
</section><!-- .comments -->
<?php endif; // check have_comments ?>

<?php if ( comments_open() ) : ?>
<section class="comment-form" id="leave-comment">
    <div class="comment-form-container">
    <?php
        $fields = array(
            'author' => 
    '<div class="form-group row">
        <label for="author" class="col-sm-3 col-md-2 col-form-label">Name<span>*</span></label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="author" name="author" placeholder="Your name" required aria-required="true">
        </div>
    </div>',
            'email' =>
    '<div class="form-group row">
        <label for="email" class="col-sm-3 col-md-2 col-form-label">Email<span>*</span></label>
        <div class="col-sm-6">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required aria-required="true">
        </div>
    </div>',
            'url' =>
    '<div class="form-group row">
        <label for="url" class="col-sm-3 col-md-2 col-form-label">Website</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="url" name="url" placeholder="Website URL">
        </div>
    </div>'         
        );

        comment_form( array(
            'class_form'			=> 'form-horizontal',
            'comment_notes_before'	=> __( '<p>Your email address will not be published. Required fields are marked with an asterisk (*).</p>', 'dutchtown' ),
            'comment_field' =>
    '<div class="form-group row">
        <label for="comment" class="col-sm-3 col-md-2 col-form-label">Comment<span>*</span></label>
        <div class="col-sm-8">
            <textarea id="comment" class="form-control" name="comment" rows="3" required aria-required="true"></textarea>
        </div>
    </div>',
            'label_submit'			=> __( 'Post Your Comment', 'dutchtown' ),
            'format'				=> 'html5',
            'class_submit'          => 'btn btn-default btn-primary',
            'submit_field'          => '<p class="form-submit">%1$s %2$s</p>',
            'fields'                => apply_filters( 'comment_form_default_fields', $fields )
        ));
    ?>
    </div>
</section><!-- .comment-form -->
<?php endif; // check comments_open ?>