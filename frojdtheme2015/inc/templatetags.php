<?php
/**
 * Custom template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 */

use Frojd\Themes\FrojdTheme2015\FrojdTheme2015 as FrojdTheme2015;

/**
 * Translation domain.
 * 
 * Sets the domain name of the translation identifier, this is used throughout 
 * the entire theme.
 */
function get_translation_domain() {
    return FrojdTheme2015::getInstance()->translationDomain;
}