# WP-Theme-Boilerplates

Copy the following guidelines to your project readme file, can be useful when working in projects using this theme. Also remember to rename the theme to something more project specific.


## Fröjd Themes
These themes are biolerplates customized after the Wordpress Twenty themes, and with structural changes created with consideration to Fröjds processes and guidlines. Some of the guidelines below might only be available in a certain theme, probably the latest one.

### Renaming
In this theme example we use differents namespaces for each class (e.g. Frojd\Themes\FrojdTheme2015 for the main theme), all these should be renamed to the proper project theme name. Here is a list of where these names occure to easily find theme.
- Each class inside the inc-directory has a namespace with the format Frojd\Themes\FrojdTheme2015, do a search and replace for this case sensitive string and replace with {ProjectRootName}\Themes\{ProjectThemeName}
- In functions.php change the main theme namespace to the namespace chosen above, and make sure to change the name of every require of every class. Also change the class name and the instance at the bottom of the file. 
- Inside inc/templatetags.php there is a reference to the function the main theme class, change it to proper namespace used in step before. Remember to change the instance to this is get_translation_domain function as well.
- Inside inc/theme.php the translation domain is defined, change this to a proper name for the theme. Also change the name inside each translation file.
- Inside inc/theme.php change the name of the main style and main script tags.
- Inside style.css change the options at the top to whatever you want for your projekt, and change the text domain to the same as translation domain.

### General guidelines
- Most of the templates from Twenty themes are used to give examples of how the theme could be structured.
- The functionality applied to the Twenty themes has been removed, all functionality should be created depending on the project and theme.
- The translation domain used in all templates has been replaced with a global function get_translation_domain(), which is defined in functions.php. Later it has instead been included in inc/template-tags.php *(2015)*.
- The theme consists of a main class located in functions.php, almost all theme specific functionality should be located in this Class *(2014)*.
- There is also a Theme class inside the inc-directory. This should contain the setup of the theme, and main functionality which can't be separated into different classes *(2015)*.
- Functionality that can be seperated into a different file or for example Walker Classes that are used, should be located in the inc-directory and included at the top of functions.php *(2015)*.
- We try to work with plugins instead of creating theme specific functionality, this way it may be reused in other projects or turned off easily from admin.
- If a function is needed but a plugin is reduntant, try to use action and filter hooks instead of global functions. Actions should be used when something has rendered without returning a value, a filter is instead something that is used to modify an object and return a result.
- If a global function is still needed, for example get_translation_domain(), use that function to trigger a different function or variable inside the another class which will do or return what you want *(2015)*.
- If a separated functionality is needed but is theme specific, for example adding a custom post type, create a new class inside the inc-directory and call hooks inside it from functions.php *(2015)*. These classes shouldn't have a constructor themeselves, instead they should have functions that are called with actions and filters or from other functions inside the main theme class *(2015)*.
- Try to avoid too much logic in the templates, create global functions, hooks and filters which will either print or return what you need.
- Use the Wordpress function get_template_part() to render templates or blocks needed. If a template needs to accept a parameter to render, try to create an action which will call the returnTemplate function inside the theme Class, and make sure to create different actions for different templates *(2015)*.
- Try not to include markup in functions.php or any inc-files, these can easily be separated into template part files and rendered instead.
- Hooks should always be named actionHookNameHook, where "actionHookName" is the name of the hook, and "Hook" is a naming convention to easily separate from other functionality. E.g. `add_action( 'after_theme_setup', array($this, 'afterThemeSetupHook') );`. These should be located inside the __construct of the main theme Class *(2014)*.
- Filters should always be named filterNameFilter, where "filterName" is the name of the filter, and "Filter" is a naming convention to easily separate from other functionality. E.g. `add_filter( 'tiny_mce_before_init', array($this, 'tinyMceBeforeInitFilter') );`. These should be located inside the __construct of the theme Class *(2014)*.
- Shortcodes should only be used when the function needs to be used inside the WYSIWYG, otherwise we are giving functionality to editors which can trigger unexpected behaviour. Even if a shortcode should be used inside a WYSIWYG, do not call them from templates with do_shortcode(), instead create an action or function which the shortcode in turn will trigger, so the parameters used can be adjusted depending on if the functionality is triggered from a template or a WYSIWYG.
- Use the same naming conventions for global functions as Wordpress, for example a function which will print a title should be the_title(), while a function which will return the title should be get_the_title(). Make sure to pay attention to function names so they don't already exist.
- When looping through posts, try to always trigger setup_postdata() to make sure functions like the_title() will work. Remember to always trigger wp_reset_postdata() after the loop has completed.