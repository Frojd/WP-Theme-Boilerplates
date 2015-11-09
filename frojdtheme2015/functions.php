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

/** For setting up theme */
require __DIR__ . '/inc/theme.php';
use Frojd\Themes\FrojdTheme2015\Inc\Theme\Theme as Theme;


/** 
 * Helper classes
 *
 * Reference to this theme main class instances inside your separate classes to use
 * these classes, e.g. add a hook to Theme class for adding a settings field by calling 
 * function FrojdTheme2015::getInstance()->settingsInstance->registerSettings($fields);
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

/** For adding settings */
require __DIR__ . '/inc/settings.php';
use Frojd\Themes\FrojdTheme2015\Inc\Settings\Settings as Settings;


/**
 * Theme specific class
*/
class FrojdTheme2015 {
    public static $VERSION = "";
    protected static $instance = null;

    public $themeInstance;
    public $postTypesInstance;
    public $metaboxesInstance;
    public $taxonomiesInstance;
    public $settingsInstance;

    private function __construct() {
        // Classes
        $this->themeInstance = Theme::getInstance();
        $this->postTypesInstance = PostTypes::getInstance();
        $this->metaboxesInstance = Metaboxes::getInstance();
        $this->taxonomiesInstance = Taxonomies::getInstance();
        $this->settingsInstance = Settings::getInstance();

        self::$VERSION = $this->themeInstance->getThemeVersion();

        /*
         * Always seperate hooks and filters, and always name the function as actionNameHook or filterNameFilter.
         */

        // Hooks
        add_action('after_setup_theme',         array($this->themeInstance, 'afterSetupThemeHook'));
        add_action('wp_footer',                 array($this->themeInstance, 'wpFooterHook'));
        add_action('wp_enqueue_scripts',        array($this->themeInstance, 'wpEnqueueScriptsHook'));
        add_action('tiny_mce_before_init',      array($this->themeInstance, 'tinyMceBeforeInitHook'));

        /*
         * You can call hooks in other classes from here, e.g. add_action('init', array($this->postInstanse, 'initHook'));
         */

        // Filters
        add_filter('excerpt_length',            array($this->themeInstance, 'excerptLengthFilter'));
        add_filter('excerpt_more',              array($this->themeInstance, 'excerptMoreFilter'));

        // Shortcodes
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    /**
     * Renders a template
     *
     * Do not call this directly in the theme, create a custom hook which calls this
     */
    public function renderTemplate($name, $vars = array()) {
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
    public function returnTemplate($name, $vars = array()) {
        ob_start();
        $this->renderTemplate($name, $vars);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}

FrojdTheme2015::getInstance();