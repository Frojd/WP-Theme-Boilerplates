<?php
/**
 * Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 */

/** Namespace should have format ProjectName\Location\ThemeName **/
namespace Frojd\Themes\FrojdTheme2015;


/**
 * Custom template tags for this theme.
 *
 * These are helper functions which can be called in the theme, 
 * in return they may call functions in the specific theme class below.
 * This doesn't have a class, so it doesn't need a namespace
 */
require __DIR__ . '/inc/templatetags.php';


/**
 * Custom classes for the theme
 * 
 * Use these instead of plugins to separate functionality, 
 * so they still are theme specific, for example custom post types
 */

/** For creating post types */
require __DIR__ . '/inc/posttypes.php';
use Frojd\Themes\FrojdTheme2015\Inc\PostTypes\PostTypes as PostTypes;

/** For creating metaboxes */
require __DIR__ . '/inc/metaboxes.php';
use Frojd\Themes\FrojdTheme2015\Inc\Metaboxes\Metaboxes as Metaboxes;

/** For creating taxonomies */
require __DIR__ . '/inc/taxonomies.php';
use Frojd\Themes\FrojdTheme2015\Inc\Taxonomies\Taxonomies as Taxonomies;


/**
 * Theme specific class
*/
class FrojdTheme2015 {
    public static $VERSION = "";
    protected static $instance = null;

    // Sets the translation domain used for the theme
    public $translationDomain = 'frojdtheme2015';

    public $postInstance;

    private function __construct() {
        self::$VERSION = $this->getThemeVersion();

        // Classes
        $this->postInstance = Post::getInstance();

        /*
         * Always seperate hooks and filters, and always name the function as actionNameHook or filterNameFilter.
         */

        // Hooks
        add_action('after_setup_theme', array($this, 'afterSetupThemeHook'));
        add_action('wp_footer',         array($this, 'wpFooterHook'));

        /*
         * You can call hooks in other classes from here, e.g. add_action('init', array($this->postInstanse, 'initHook'));
         */

        // Filters

        // Shortcodes
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
     * Theme setup.
     *
     * Sets up theme defaults and registers the various WordPress features.
     *
     */
    public function afterSetupThemeHook() {
        /*
         * Makes theme available for translation.
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