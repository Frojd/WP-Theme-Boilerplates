<article <?php post_class('entry'); ?>>
    <div class="entry__main">
        <header class="entry__header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="entry__thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>

            <h1 class="entry__title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry__content">
            <?php the_content(); ?>
            <div class="entry__pagination">
                <?php wp_link_pages(
                    array(
                        'before' => '<div class="pagination"><span class="pagination__title">' . __( 'Pages:', get_translation_domain() ) . '</span>', 
                        'after' => '</div>', 
                        'link_before' => '<span>',
                        'link_after' => '</span>'
                    )
                ); ?>
            </div>
        </div><!-- .entry__content -->
    </div><!-- .entry__main -->
</article><!-- .entry -->
