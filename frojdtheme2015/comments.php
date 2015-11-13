<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<div class="comments">
    <div class="comments__content">
        <?php if ( have_comments() ) : ?>
            <h2 class="comments__title">
                <?php
                    printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', get_translation_domain() ),
                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                ?>
            </h2>

            <ol class="comments__list">
                <?php
                    wp_list_comments( array(
                        'style'       => 'ol',
                        'short_ping'  => true,
                        'avatar_size' => 74,
                    ) );
                ?>
            </ol><!-- .comments__list -->

            <?php
                // Are there comments to navigate through?
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
                <nav class="comments__nav" role="navigation">
                    <h1 class="comments__nav-title"><?php _e( 'Comment navigation', get_translation_domain() ); ?></h1>
                    <div class="comments__nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', get_translation_domain() ) ); ?></div>
                    <div class="comments__nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', get_translation_domain() ) ); ?></div>
                </nav><!-- .comments__nav -->
            <?php endif; // Check for comment navigation ?>

            <?php if ( ! comments_open() && get_comments_number() ) : ?>
                <p class="comments__closed"><?php _e( 'Comments are closed.' , get_translation_domain() ); ?></p>
            <?php endif; ?>

        <?php endif; // have_comments() ?>

        <div class="comments__form">
            <?php comment_form(); ?>
        </div>
    </div><!-- .comments__content -->
</div><!-- .comments -->