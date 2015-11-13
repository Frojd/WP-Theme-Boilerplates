<?php get_template_part('parts/header', 'head'); ?>

<body <?php body_class(); ?>>
    <div class="container">
        <header class="header" role="banner">
            <div class="header__content">
                <a class="header__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <h1 class="header__title"><?php bloginfo( 'name' ); ?></h1>
                    <h2 class="header__description"><?php bloginfo( 'description' ); ?></h2>
                </a>

                <div class="header__nav">
                    <nav class="nav" role="navigation">
                        <h3 class="nav__toggle"><?php _e( 'Menu', get_translation_domain() ); ?></h3>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav__menu' ) ); ?>
                        <?php get_search_form(); ?>
                    </nav><!-- .nav -->
                </div><!-- .header__nav -->
            </div><!-- .header__content -->
        </header><!-- .header -->

        <div class="main">
