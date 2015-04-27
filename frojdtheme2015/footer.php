<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Frojd_Theme_2015
 * @since Fröjd Theme 2015 1.0
 */

namespace Frojd\Theme\Frojd;
?>

            </div><!-- #main -->
            <footer id="colophon" class="site-footer" role="contentinfo">
                <div class="site-info">
                    <a href="<?php echo esc_url( __( 'http://wordpress.org/', get_translation_domain() ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', get_translation_domain() ); ?>"><?php printf( __( 'Proudly powered by %s', get_translation_domain() ), 'WordPress' ); ?></a>
                </div><!-- .site-info -->
            </footer><!-- #colophon -->
        </div><!-- #page -->

        <?php wp_footer(); ?>
    </body>
</html>