# WP-Theme-Boilerplates

## Fröjd Themes
These themes are biolerplates customized after the Wordpress Twenty themes, and with structural changes created with consideration to Fröjds processes and guidlines. Some of the guidelines below might only be available in a certain theme, probably the latest one.

### General guidelines
- Most of the templates from Twenty themes are used to give examples of how the theme could be structured.
- The functionality applied to the Twenty themes has been removed, all functionality should be created depending on the project and theme.
- The translation domain used in all templates have been replaced with a global function get_translation_domain(), which is defined in functions.php. Later it has instead been included in inc/template-tags.php *(2015)*.
- The theme consists of a main class located in functions.php, almost all theme specific functionality should be located in this Class *(2014)*.
- Functionality that can be seperated into a different file or for example Walker Classes that are used, should be located in the inc-direcotry and included at the top of functions.php *(2015)*.
- We try to work with plugins instead of creating theme specific functionality, this way it may be reused in other projects or turned off easily from admin.
- If a function is needed but a plugin is reduntant, try to use action and filter hooks instead of global functions. Actions should be used when something has to be triggered or rendered without returning a value, a filter is instead something that is used to modify an object and return a result.
- If a global function is still needed, for example get_translation_domain(), use that function to trigger a different function or variable inside the theme Class which will do or return what you want *(2014)*.
- Try to avoid too much logic in the templates, create hooks and filters which will either print or return what you need.
- Use the Wordpress function get_template_part() to render templates or blocks needed. If a template needs to accept a parameter to render, try to create an action which will call the returnTemplate function inside the theme Class, and make sure to create different actions for different templates *(2015)*.
- Try not to include markup in functions.php or any inc-files, these can easily be separated into template part files and rendered instead.
- Hooks should always be named actionHookNameHook, where "actionHookName" is the name of the hook, and "Hook" is a nameing convention to easily separate from other functionality. E.g. `add_action( 'after_theme_setup', array($this, 'afterThemeSetupHook') );`. These should be located inside the __construct of the theme Class *(2014)*.
- Filters should always be named filterNameFilter, where "filterName" is the name of the filter, and "Filter" is a nameing convention to easily separate from other functionality. E.g. `add_filter( 'tiny_mce_before_init', array($this, 'tinyMceBeforeInitFilter') );`. These should be located inside the __construct of the theme Class *(2014)*.
- Shortcodes should only be used when the function needs to be used inside the WYSIWYG, otherwise we are giving functionality to editors which can trigger unexpected behaviour. Even if a shortcode should be used inside a WYSIWYG, do not call them from template with do_shortcode(), instead create an action or function which the shortcode in turn will trigger, so the parameters used can be adjusted depending on if the functionality is triggered from a template or a WYSIWYG.
- Use the same naming conventions as Wordpress, for example a function which will print a title should be the_title(), while a function which will return the title should be get_the_title().
- When looping through posts, try to always trigger setup_postdata() to make sure functions like the_title() will work. Remember to always trigger wp_reset_postdata() after the loop as well.