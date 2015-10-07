<?php
/**
 * Helper class for posttypes
 *
 * To register a new post type, call the function registerPostType from the action hook "init".
 * Arguments sent in are the same as applied to the register_post_type function.
 * (https://codex.wordpress.org/Function_Reference/register_post_type)
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\PostTypes;

class PostTypes {
    protected static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    public function registerPostType($postType, $single, $plural, $args = array()) {
        $labels = array(
            'name'                  => $plural,
            'singular_name'         => $single,
            'menu_name'             => $plural,
            'name_admin_bar'        => $single,
            'all_items'             => sprintf( __( 'All %s', get_translation_domain() ), $plural ),
            'add_new'               => __( 'Add new', get_translation_domain() ),
            'add_new_item'          => sprintf( __( 'Add new %s', get_translation_domain() ), $single ),
            'edit_item'             => sprintf( __( 'Edit %s', get_translation_domain() ), $single ),
            'new_item'              => sprintf( __( 'New %s', get_translation_domain() ), $single ),
            'view_item'             => sprintf( __( 'View %s', get_translation_domain() ), $single ),
            'search_items'          => sprintf( __( 'Search %s', get_translation_domain() ), $single ),
            'not_found'             => sprintf( __( 'No %s found', get_translation_domain() ), $plural ),
            'not_found_in_trash'    => sprintf( __( 'No %s found in Trash', get_translation_domain() ), $plural ),
            'parent_item_colon'     => sprintf( __( 'Parent %s', get_translation_domain() ), $single )
        );

        $args['labels'] = isset($args['labels']) ? array_merge($labels, $args['labels']) : $labels;
        $args['label'] = isset($args['label']) ? $args['label'] : $plural;

        register_post_type($postType, $args);
    }

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/
}