<?php
/**
 * Custom template tags for Sharing Sweden
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Sharing_Sweden
 * @since Sharing Sweden 1.0
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