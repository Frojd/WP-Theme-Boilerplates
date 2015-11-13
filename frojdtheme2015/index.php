<?php get_header(); ?>

    <div class="content">
        <div class="content__main" role="main">

            <div class="content__entry">
                <?php if ( have_posts() ) : ?>

                    <?php /* The loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'entry', get_post_type() ); ?>
                    <?php endwhile; ?>

                <?php else : ?>
                    <?php get_template_part( 'entry', 'none' ); ?>
                <?php endif; ?>

            </div><!-- .content__entry -->

        </div><!-- .content__main -->
    </div><!-- .content -->

<?php get_footer(); ?>