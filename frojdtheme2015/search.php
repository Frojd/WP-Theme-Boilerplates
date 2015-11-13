<?php get_header(); ?>

    <div class="content">
        <div class="content__main" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="content__header">
                    <h1 class="content__title"><?php printf( __( 'Search Results for: %s', get_translation_domain() ), get_search_query() ); ?></h1>
                </header><!-- .content__header -->

                <?php /* The loop */ ?>
                <div class="content__entry">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'entry', get_post_format() ); ?>
                    <?php endwhile; ?>
                </div><!-- .content__entry -->

            <?php else : ?>
                <div class="content__entry">
                    <?php get_template_part( 'entry', 'none' ); ?>
                </div><!-- .content__entry -->
            <?php endif; ?>

        </div><!-- .content__main -->
    </div><!-- .content -->

<?php get_footer(); ?>