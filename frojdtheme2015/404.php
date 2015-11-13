<?php get_header(); ?>

    <div class="content">
        <div class="content__main" role="main">

            <header class="content__header">
                <h1 class="content__title"><?php _e( 'Not found', get_translation_domain() ); ?></h1>
            </header><!-- .content__header -->

            <div class="content__entry">
                <?php get_template_part('entry', '404'); ?>
            </div><!-- .content__entry -->

        </div><!-- .content__main -->
    </div><!-- .content -->

<?php get_footer(); ?>