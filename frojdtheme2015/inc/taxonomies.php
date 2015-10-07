<?php
/**
 * Helper class for taxonomies
 *
 * To register a new taxonomy, call the function registerTaxonomy from the action hook "init".
 * Arguments sent in are the same as applied to the register_taxonomy function.
 * (https://codex.wordpress.org/Function_Reference/register_taxonomy)
 *
 * Ta add a new field to taxonomy add view, call the function addTaxonomyFormFields from the 
 * action hook "{taxonomy}_add_form_fields".
 * Ta add a new field to taxonomy edit view, call the function editTaxonomyFormFields from the
 * action hook "{taxonomy}_edit_form_fields".
 * To save these fields call the function save saveTaxonomy from the action hooks 
 * "create_{taxonomy}" and "edit_{taxonomy}".
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\Taxonomies;

class Taxonomies {
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

    public function addTaxonomyFormFields($label, $taxonomy, $name, $type = 'text') {
        $option = get_option('taxonomy_' . $taxonomy . '_' . $name);
        ?>
        <div class="form-field">
            <label for="term_meta_<?php echo $name; ?>"><?php echo $label; ?></label>
            <input type="<?php echo $type; ?>" name="term_meta[<?php echo $name; ?>]" id="term_meta_<?php echo $name; ?>">
        </div>
        <?php
    }

    public function editTaxonomyFormFields($label, $taxonomy, $name, $term, $type = 'text') {
        $option = get_option('taxonomy_' . $taxonomy . '_' . $name);
        $value = isset($option[$term->term_id]) ? $option[$term->term_id] : '';
        ?>

        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="term_meta_<?php echo $name; ?>"><?php echo $label; ?></label>
            </th>
            <td>
                <input type="<?php echo $type; ?>" name="term_meta[<?php echo $name; ?>]" id="term_meta_<?php echo $name; ?>" value="<?php echo $value; ?>">
            </td>
        </tr>

        <?php
    }

    public function saveTaxonomy($taxonomy, $name, $value, $termId) {
        $option = get_option('taxonomy_' . $taxonomy . '_' . $name);
        if(isset($value) && !empty($value)) {
            $option[$termId] = $value;
        } else {
            unset($option[$termId]);
        }
        update_option('taxonomy_' . $taxonomy . '_' . $name, $option);
    }

    public function registerTaxonomy($taxonomy, $single, $plural, $objectType, $args = array()) {
        $labels = array(
            'name'                          => $plural,
            'singular_name'                 => $single,
            'menu_name'                     => $plural,
            'all_items'                     => sprintf( __( 'All %s', get_translation_domain() ), $plural ),
            'edit_item'                     => sprintf( __( 'Edit %s', get_translation_domain() ), $single ),
            'view_item'                     => sprintf( __( 'View %s', get_translation_domain() ), $single ),
            'update_item'                   => sprintf( __( 'Update %s', get_translation_domain() ), $single ),
            'add_new_item'                  => sprintf( __( 'Add new %s', get_translation_domain() ), $single ),
            'new_item_name'                 => sprintf( __( 'New %s Name', get_translation_domain() ), $single ),
            'parent_item'                   => sprintf( __( 'Parent %s', get_translation_domain() ), $single ),
            'parent_item_colon'             => sprintf( __( 'Parent %s:', get_translation_domain() ), $single ),
            'search_items'                  => sprintf( __( 'Search %s', get_translation_domain() ), $plural ),
            'popular_items'                 => sprintf( __( 'Popular %s', get_translation_domain() ), $plural ),
            'separate_items_with_commas'    => sprintf( __( 'Separate %s with commas', get_translation_domain() ), $plural ),
            'add_or_remove_items'           => sprintf( __( 'Add or remove %s', get_translation_domain() ), $plural ),
            'choose_from_most_used'         => sprintf( __( 'Choose from the most used %s', get_translation_domain() ), $plural ),
            'not_found'                     => sprintf( __( 'No %s found', get_translation_domain() ), $plural )
        );
        $args['labels'] = isset($args['labels']) ? array_merge($labels, $args['labels']) : $labels;

        register_taxonomy($taxonomy, $objectType, $args);
    }

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/
}