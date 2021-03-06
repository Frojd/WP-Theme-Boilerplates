<?php
/**
 * Fröjd Theme 2013 functions and definitions
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
 * @subpackage Frojd_Theme_2013
 * @since Fröjd Theme 2013 1.0
 */


/**
 * Fröjd Theme 2013 translation domain.
 * 
 * Sets the domain name of the translation identifier, this is used throughout 
 * the entire theme.
 *
 * @since Fröjd Theme 2013 1.0
 *
 * @return string Translation domain.
 */
function get_translation_domain() {
	return 'frojdtheme2013';
}

/**
 * Fröjd Theme 2013 setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Fröjd Theme 2013 supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since Fröjd Theme 2013 1.0
 *
 * @return void
 */
function frojdtheme_setup() {
	/*
	 * Makes Fröjd Theme 2013 available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( get_translation_domain(), get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'frojdtheme_setup' );