<?php
/**
 * Theme class
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\Theme;

class Theme {
    protected static $instance = null;

    // Sets the translation domain used for the theme
    public $translationDomain = 'frojdtheme2015';

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
        $this->addThemeSupport();
        $this->loadTextDomain();
    }

    /**
     * Hook for wp_footer function, called in footer.php
     */
    public function wpFooterHook() {
        // Renderes the browser-update javascript code to footer
        get_template_part('parts/browser-update');
    }

    /**
     * Hook for enqueing styles and javascripts
     */
    public function wpEnqueueScriptsHook() {
        $this->enqueueScripts();
    }

    /**
     * Hook for settings in tiny mce Wysiwyg
     */
    public function tinyMceBeforeInitHook($format) {
        return $this->tinyMceFormats($format);
    }

    /*------------------------------------------------------------------------*
     * Filters
     *------------------------------------------------------------------------*/
    
    public function excerptLengthFilter() {
        return 55;
    }

    public function excerptMoreFilter($more) {
        return '...';
    }

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    public function getThemeVersion() {
        $theme = wp_get_theme();
        $version = $theme["Version"];

        return $version;
    }

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

    private function addThemeSupport() {
        // Add support for feature image
        add_theme_support('post-thumbnails');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');
    }

    private function loadTextDomain() {
        /*
         * Makes theme available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain($this->translationDomain, get_template_directory() . '/languages');
    }

    private function enqueueScripts() {
        // Sets the suffix of scripts, should use minimized on production
        $suffix = '';
        if (!WP_DEBUG) {
            $suffix = "-min";
        }

        // Loads our main stylesheet.
        wp_enqueue_style(
            'frojd-theme-style',
            get_template_directory_uri() . '/builds/css/main' . $suffix . '.css',
            array(),
            $this->getThemeVersion(),
            'all'
        );

        // Loads our main javascript.
        wp_enqueue_script(
            'frojd-theme-script',
            get_template_directory_uri() . '/builds/js/main' . $suffix . '.js',
            array('jquery'),
            $this->getThemeVersion(),
            true
        );
    }

    private function tinyMceFormats($init) {
        return $init;
    }
}