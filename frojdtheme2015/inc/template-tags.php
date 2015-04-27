<?php
/**
 * Custom template tags for Fröjd Theme 2015
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Fröjd_Theme
 * @since Fröjd Theme 1.0
 */

namespace Frojd\Theme\Frojd;

/**
 * Translation domain.
 * 
 * Sets the domain name of the translation identifier, this is used throughout 
 * the entire theme.
 */
function get_translation_domain() {
    return FrojdTheme2015::getInstance()->translationDomain;
}