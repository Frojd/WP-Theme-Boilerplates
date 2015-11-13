            </div><!-- .main -->
            <footer class="footer" role="contentinfo">
                <div class="footer__content">
                    <a href="<?php echo esc_url( __( 'http://wordpress.org/', get_translation_domain() ) ); ?>" class="footer__link" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', get_translation_domain() ); ?>"><?php printf( __( 'Proudly powered by %s', get_translation_domain() ), 'WordPress' ); ?></a>
                </div><!-- .footer__content -->
            </footer><!-- .footer -->
        </div><!-- .container -->

        <?php wp_footer(); ?>
    </body>
</html>