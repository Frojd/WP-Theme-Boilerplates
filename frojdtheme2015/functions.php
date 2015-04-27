<?php
/**
 * Fröjd Theme 2015 functions and definitions
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
 * @subpackage Frojd_Theme_2015
 * @since Fröjd Theme 2015 1.0
 */

namespace Frojd\Theme\Frojd;


/**
 * Custom template tags for this theme.
 *
 * These are helper functions which can be called in the theme, 
 * in return they may call functions in the specific theme class below
 *
 * @since Fröjd Theme 2015 1.0
 */
require __DIR__ . '/inc/template-tags.php';


/**
 * Theme specific class
*/
class FrojdTheme2015 {
    public static $VERSION = "";
    protected static $instance = null;

    // Sets the translation domain used for the theme
    public $translationDomain = 'frojdtheme2015';

    private function __construct() {
        self::$VERSION = $this->getThemeVersion();

        /*
         * Always seperate hooks and filters, and always name the function as actionNameHook or filterNameFilter.
         */

        // Hooks
        add_action('after_setup_theme', array($this, 'afterSetupThemeHook'));
        add_action('wp_footer', array($this, 'wpFooterHook'));

        // Filters
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
     * Fröjd Theme 2015 setup.
     *
     * Sets up theme defaults and registers the various WordPress features.
     *
     */
    public function afterSetupThemeHook() {
        /*
         * Makes Fröjd Theme 2015 available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain($this->translationDomain, get_template_directory() . '/languages');
    }

    /**
     * Hook for wp_footer function, called in footer.php
     */
    public function wpFooterHook() {
        // Renderes the browser-update javascript code to footer
        get_template_part('parts/browser-update');
    }

    /*------------------------------------------------------------------------*
     * Filters
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

    /**
     * Renders a template
     *
     * Do not call this directly in the theme, create a custom hook which calls this
     */
    private function renderTemplate($name, $vars = array()) {
        foreach ($vars as $key => $val) {
            $$key = $val;
        }
        include(locate_template($name . '.php'));
    }

    /**
     * Returns a template
     *
     * Do not call this directly in the theme, create a custom filter which returns this
     */
    private function returnTemplate($name, $vars = array()) {
        ob_start();
        $this->renderTemplate($name, $vars);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * Sets the theme version
     *
     */
    private function getThemeVersion() {
        $theme = wp_get_theme();
        $version = $theme["Version"];

        return $version;
    }
}

FrojdTheme2015::getInstance();