<?php get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php if ( have_posts() ) : ?>
                <header class="archive-header">
                    <h1 class="archive-title"><?php
                        if ( is_day() ) :
                            printf( __( 'Daily Archives: %s', get_translation_domain() ), get_the_date() );
                        elseif ( is_month() ) :
                            printf( __( 'Monthly Archives: %s', get_translation_domain() ), get_the_date( _x( 'F Y', 'monthly archives date format', get_translation_domain() ) ) );
                        elseif ( is_year() ) :
                            printf( __( 'Yearly Archives: %s', get_translation_domain() ), get_the_date( _x( 'Y', 'yearly archives date format', get_translation_domain() ) ) );
                        else :
                            _e( 'Archives', get_translation_domain() );
                        endif;
                    ?></h1>
                </header><!-- .archive-header -->

                <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>