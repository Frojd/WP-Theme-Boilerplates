<?php
/**
 * Custom template tags for Fröjd Theme 2015
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Frojd_Theme_2015
 * @since Fröjd Theme 2015 1.0
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\Post;

class Post {
    protected static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*------------------------------------------------------------------------*
     * Hooks
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Filters
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/
}
