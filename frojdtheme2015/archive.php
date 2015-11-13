<?php get_header(); ?>

    <div class="content">
        <div class="content__main" role="main">

            <?php if ( have_posts() ) : ?>
                <header class="content__header">
                    <h1 class="content__title"><?php
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
                </header><!-- .content__header -->

                <div class="content__entry">
                    <?php /* The loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'entry', get_post_type() ); ?>
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