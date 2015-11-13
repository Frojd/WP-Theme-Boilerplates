<div class="entry">
    <div class="entry__main">
        <header class="entry__header">
            <h1 class="entry__title"><?php _e( 'Nothing Found', get_translation_domain() ); ?></h1>
        </header><!-- .entry__header -->

        <div class="entry__content">
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', get_translation_domain() ), admin_url( 'post-new.php' ) ); ?></p>

            <?php elseif ( is_search() ) : ?>

                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', get_translation_domain() ); ?></p>
                <?php get_search_form(); ?>

            <?php else : ?>

                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', get_translation_domain() ); ?></p>
                <?php get_search_form(); ?>

            <?php endif; ?>
        </div><!-- .entry__content -->
    </div><!-- .entry__main -->
</div><!-- .entry -->