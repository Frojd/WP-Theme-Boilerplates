<?php
/**
 * Fröjd Theme 2014 functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Frojd_Theme_2014
 * @since Fröjd Theme 2014 1.0
 */

/**
 * WP Helper functions
 *
 * General functions used in the theme or even in plugins if needed,
 * which are built from WP standards and used only as helpers.
*/

/**
 * Translation domain.
 * 
 * Sets the domain name of the translation identifier, this is used throughout 
 * the entire theme.
 */
function get_translation_domain() {
	return FrojdTheme2014::getInstance()->translation_domain;
}


/**
 * Theme specific class
*/
class FrojdTheme2014 {
    public static $VERSION = "";
    protected static $instance = null;
    public static $translation_domain = 'frojdtheme2014';

    private function __construct() {
        self::$VERSION = $this->getThemeVersion();

        add_action('after_setup_theme', array($this, 'afterSetupThemeHook'));
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*------------------------------------------------------------------------*
     * Hooks
     *------------------------------------------------------------------------*/

    /**
     * Fröjd Theme 2014 setup.
     *
     * Sets up theme defaults and registers the various WordPress features.
     *
     */
    function afterSetupThemeHook() {
        /*
         * Makes Fröjd Theme 2014 available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain(get_translation_domain(), get_template_directory() . '/languages');
    }



    /*------------------------------------------------------------------------*
     * Shortcodes
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

    private function getThemeVersion() {
        $theme = wp_get_theme();
        $version = $theme["Version"];

        return $version;
    }
}

FrojdTheme2014::get_instance();