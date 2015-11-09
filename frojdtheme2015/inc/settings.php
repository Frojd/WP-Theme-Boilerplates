<?php
/**
 * Helper class for settings
 * 
 * Used to add fields (input or textarea) to different settings pages and saving this data. 
 * The functions used to create the setting are add_settings_field and register_setting. 
 * This is mainly used to register settings to the main wordpress settings pages.
 *
 * The paramater "id" is required, make sure this is unique since this will be used as the id for
 * saving the data. Options that are available are label, default, type (textarea or input types), 
 * callback page (e.g. "general") and section (e.g. "default"). The callback parameter can be used 
 * for using your own callback functions in your own classes when you need to display options 
 * differently (e.g. a dropdown with a list of alla pages).
 */

namespace Frojd\Themes\FrojdTheme2015\Inc\Settings;

class Settings {
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

    public function registerSettings($fields = array()) {
        foreach($fields as $field) {
            if(isset($field['id'])) {
                $label = isset($field['label']) ? $field['label'] : '';
                $callback = isset($field['callback']) ? $field['callback'] : array(&$this, 'renderField');
                $page = isset($field['page']) ? $field['page'] : 'general';
                $section = isset($field['section']) ? $field['section'] : 'default';
                add_settings_field($field['id'],
                    '<label for="' . $field['id'] . '">' . $label . '</label>',
                    $callback, $page, $section, $field);

                register_setting($page, $field['id'], 'esc_attr');
            }
        }
    }

    public function renderField($field) {
        $option = get_option($field['id'], isset($field['default']) ? $field['default'] : '');
        if(!isset($field['type'])) {
            $field['type'] = 'text';
        }
        switch($field['type']) {
            case 'textarea':
                echo '<textarea id="' . $field['id'] . '" name="' . $field['id'] . '" rows="5" style="width: 400px;">' . esc_attr($option) . '</textarea>';
                break;
            default:
                echo '<input type="' . $field['type'] . '" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . $option . '" />';
                break;
        }
    }

    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

}
