<?php
/**
 * Helper class for metaboxes
 * 
 * Used to add metaboxes with different types of fields (different input fields, select, textarea etc.)
 * and to save these types of data.
 * 
 * The whole metabox and each field support a capabilities option, and uses the function 
 * current_user_can to see if the user has capability to edit that.
 * The metabox supports function to use a dropdown as single selection of a taxonomy instead of the
 * built-in checkbox selection. Remember to deactivate the taxonomy div aswell.
 * 
 * Supported field options: type (input field types, textarea, select, checkbox, radio, content, button),
 * id, label, description, class, separator (bool), multiple (bool), options (array), button, content,
 * capabilities (array), taxonomy (bool)
 * Some options are required by a specific field type, and id is required for all
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\Metaboxes;

class Metaboxes {
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

    public function savePost($postId, $metaBoxes) {
        foreach($metaBoxes as $id => $metaBox) {
            if(isset($metaBox['args']['fields']) && isset($_POST['metabox_data']) && in_array($id, $_POST['metabox_data'])) {
                foreach($metaBox['args']['fields'] as $field) {
                    if(isset($field['id'])) {
                        if(isset($_POST[$field['id']])) {
                            update_post_meta($postId, $field['id'], $_POST[$field['id']]);
                        } else if(isset($field['type']) && $field['type'] == 'checkbox') {
                            update_post_meta($postId, $field['id'], '');
                        }
                    }
                }
            }
        }
    }

    public function addMetaBoxes($metaBoxes) {
        foreach($metaBoxes as $id => $metaBox) {
            $authorized = true;
            if(isset($metaBox['capabilities'])) {
                foreach($metaBox['capabilities'] as $capability) {
                    if(!current_user_can($capability)){
                        $authorized = false;
                        break;
                    }
                }
            }
            if($authorized) {
                $postTypes = isset($metaBox['post_types']) ? $metaBox['post_types'] : array('post');
                foreach($metaBox['post_types'] as $postType) {
                    add_meta_box(
                        $id,
                        isset($metaBox['title']) ? $metaBox['title'] : '',
                        array($this, 'metaBoxCallback'),
                        $postType,
                        isset($metaBox['context']) ? $metaBox['context'] : 'advanced',
                        isset($metaBox['priority']) ? $metaBox['priority'] : 'default',
                        isset($metaBox['args']) ? $metaBox['args'] : array()
                    );
                }
            }
        }
    }

    public function metaBoxCallback($post, $metaBox) {
        if(!empty($metaBox['args']['fields'])) : ?>
            <input type="hidden" name="metabox_data[]" value="<?php echo $metaBox['id']; ?>">
            <table width="100%">
                <tbody>
                    <?php
                        foreach($metaBox['args']['fields'] as $field) {
                            if(isset($field['id'])) {
                                $field['value'] = get_post_meta($post->ID, $field['id'], true);

                                /* If taxonomy is set to true, it will register the setting as a selected term, 
                                 * not a separate setting. This is useful when an editor only should be able to 
                                 * select a single term, not the default functionality of multiple terms. Make sure 
                                 * to hide the taxonomy-div if this is used
                                 */
                                if(isset($field['taxonomy']) && !empty($field['taxonomy'])) {
                                    $field['id'] = 'tax_input[' . $field['taxonomy'] . '][]';
                                    $terms = wp_get_post_terms($post->ID, $field['taxonomy'], array('fields' => 'ids'));
                                    if(!empty($terms)) {
                                        $field['value'] = $terms[0];
                                    }
                                }

                                $field['type'] = isset($field['type']) ? $field['type'] : 'text';

                                // Restrict field to user with specific capabilites if array with capabilites values exists.
                                $authorized = true;
                                if(isset($field['capabilities'])) {
                                    foreach($field['capabilities'] as $capability) {
                                        if(!current_user_can($capability)){
                                            $authorized = false;
                                            break;
                                        }
                                    }
                                }
                                if($authorized) {
                                    $this->renderField($field);
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        <?php endif;
    }

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

    private function renderField($field) {
        $class = isset($field['class']) ? ' class="' . $field['class'] . '"' : '';
        $multiple = isset($field['multiple']) && $field['multiple'];
    ?>
        <tr>
            <?php if(isset($field['label'])) : ?>
                <td style="vertical-align: top; width: 200px;">
                    <?php if($field['type'] == 'checkbox') : ?>
                        <?php echo $field['label']; ?>
                    <?php else : ?>
                        <label for="<?php echo $field['id']; ?>"><?php echo $field['label']; ?></label>
                    <?php endif; ?>
                </td>
            <?php endif; ?>

            <td colspan="<?php echo isset($field['label']) ? 1 : 2; ?>">
                <?php switch($field['type']) :
                    case 'textarea': ?>
                        <textarea id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>"<?php echo $class; ?>><?php echo $field['value']; ?></textarea>
                        <?php break;

                    case 'select': ?>
                        <?php if(isset($field['options'])) : ?>
                            <select id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?><?php echo $multiple ? '[]' : ''; ?>"<?php echo $multiple ? ' multiple' : ''; ?><?php echo $class; ?>>
                                <option value="">-- <?php echo $multiple ? __('None', get_translation_domain()) : __('Choose', get_translation_domain()); ?> --</option>
                                <?php foreach ($field['options'] as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($multiple && in_array($key, $field['value'])) || $key == $field['value'] ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif;
                        break;

                    case 'checkbox': ?>
                        <input type="<?php echo $field['type']; ?>" id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>" <?php echo $field['value'] && $field['value'] == 'on' ? ' checked="checked"' : ''; ?><?php echo $class; ?>>
                        <?php if(isset($field['checkbox_label'])) : ?>
                             <label for="<?php echo $field['id']; ?>"><?php echo $field['checkbox_label']; ?></label>
                        <?php endif; ?>
                        <?php break;

                    case 'radio': ?>
                        <?php if(isset($field['options'])) : ?>
                            <?php foreach ($field['options'] as $key => $value) : ?>
                                <input type="<?php echo $field['type']; ?>" id="<?php echo $field['id']; ?>_<?php echo $key; ?>" name="<?php echo $field['id']; ?>" value="<?php echo $key; ?>"<?php echo $field['value'] == $key ? ' checked="checked"' : ''; ?><?php echo $class; ?>> <label for="<?php echo $field['id']; ?>_<?php echo $key; ?>" style="margin-right: 10px;"><?php echo $value; ?></label>
                            <?php endforeach; ?>
                        <?php endif;
                        break;

                    case 'content': ?>
                        <?php if(isset($field['content'])) : ?>
                            <div id="<?php echo $field['id']; ?>"<?php echo $class; ?>><?php echo $field['content']; ?></div>
                        <?php endif;
                        break;

                    case 'button': ?>
                        <?php if(isset($field['button'])) : ?>
                            <button id="<?php echo $field['id']; ?>"<?php echo $class; ?>><?php echo $field['button'] ?></button>
                        <?php endif;
                        break;

                    default: ?>
                        <input id="<?php echo $field['id']; ?>" type="<?php echo $field['type']; ?>" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>"<?php echo $class; ?>>
                        <?php break; ?>
                <?php endswitch; ?>

                <?php if(isset($field['description'])) : ?>
                    <p style="margin: 5px 0;"><i><?php echo $field['description']; ?></i></p>
                <?php endif; ?>
            </td>
        </tr>
        <?php if(isset($field['separator']) && $field['separator']) : ?>
                </tbody>
            </table>
            <hr>
            <table>
                <tbody>
        <?php endif; ?>
    <?php
    }
}