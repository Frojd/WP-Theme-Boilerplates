<article <?php post_class('entry'); ?>>
    <div class="entry__main">
        <header class="entry__header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="entry__thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_single() ) : ?>
                <h1 class="entry__title"><?php the_title(); ?></h1>
            <?php else : ?>
                <h1 class="entry__title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
            <?php endif; // is_single() ?>
        </header><!-- .entry-header -->

        <div class="entry__content">
            <?php if ( is_search() ) : // Only display Excerpts for Search ?>
                <?php the_excerpt(); ?>
            <?php else : ?>
                <?php the_content( __( 'Continue reading', get_translation_domain() ) ); ?>
                <?php wp_link_pages(
                    array(
                        'before' => '<div class="pagination"><span class="pagination__title">' . __( 'Pages:', get_translation_domain() ) . '</span>', 
                        'after' => '</div>', 
                        'link_before' => '<span>',
                        'link_after' => '</span>'
                    )
                ); ?>
            <?php endif; ?>
        </div><!-- .entry__content -->
    </div><!-- .entry__main -->
</article><!-- .entry -->
