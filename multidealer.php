<?php /*
Plugin Name: MultiDealer 
Plugin URI: http://multidealerplugin.com
Description: Dealers and Real Estate Brokers can manage, list and sell products online quickly by create custom fieds.
Version: 2.18
Text Domain: multidealer
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('MULTIDEALERVERSION', '2.18');
define('MULTIDEALERPATH', plugin_dir_path(__file__));
define('MULTIDEALERURL', plugin_dir_url(__file__));
define('MULTIDEALERIMAGES', plugin_dir_url(__file__) . 'assets/images/');
include_once(ABSPATH . 'wp-includes/pluggable.php');
$multidealer_auto_updates = trim(get_option('multidealer_auto_updates',  ''));
$multidealer_is_admin = multidealer_check_wordpress_logged_in_cookie();

function multidealer_plugin_settings_link($links)
{
    $settings_link = '<a href="options.php?page=md_settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__file__);
if ($multidealer_is_admin) {
    add_action('plugins_loaded', 'multidealer_localization_init');
}
add_filter("plugin_action_links_$plugin", 'multidealer_plugin_settings_link');
//require_once (MULTIDEALERPATH . "settings/load-plugin.php");
add_action('init', 'load_multidealer_plugin_settings');

function load_multidealer_plugin_settings()
{
    require_once(MULTIDEALERPATH . 'settings/load-plugin.php');
    require_once(MULTIDEALERPATH . "settings/options/plugin_options_tabbed.php");
}


require_once(MULTIDEALERPATH . 'includes/contact-form/multi-contact-form.php');
require_once(MULTIDEALERPATH . 'includes/help/help.php');
require_once(MULTIDEALERPATH . 'includes/functions/functions.php');
require_once(MULTIDEALERPATH . 'includes/post-type/meta-box.php');
require_once(MULTIDEALERPATH . 'includes/post-type/post-functions.php');
require_once(MULTIDEALERPATH . 'includes/templates/template-functions.php');
require_once(MULTIDEALERPATH . 'includes/templates/redirect.php');
require_once(MULTIDEALERPATH . 'includes/widgets/widgets.php');
require_once(MULTIDEALERPATH . 'includes/search/search-function.php');
require_once(MULTIDEALERPATH . 'includes/multi/multi.php');
require_once(MULTIDEALERPATH . 'dashboard/main.php');
$Multidealer_template_gallery = trim(get_option('multidealer_template_gallery', 'yes'));
require_once(MULTIDEALERPATH . 'includes/templates/template-showroom1.php');
require_once(MULTIDEALERPATH . 'includes/multi/multi-functions.php');
if ($multidealer_is_admin) {
    require_once(MULTIDEALERPATH . 'includes/functions/health.php');
    require_once(MULTIDEALERPATH . 'includes/functions/health_permalink.php');
}
$Multidealer_template_gallery = trim(get_option(
    'multidealer_template_gallery',
    'yes'
));
if ($Multidealer_template_gallery == 'yes')
    require_once(MULTIDEALERPATH . 'includes/templates/template-showroom.php');
else
    require_once(MULTIDEALERPATH . 'includes/templates/template-showroom1.php');
$multidealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
if (strpos($multidealerurl, 'product') !== false) {
    $multidealer_overwrite_gallery = strtolower(get_option(
        'multidealer_overwrite_gallery',
        'yes'
    ));
    if ($multidealer_overwrite_gallery == 'yes')
        require_once(MULTIDEALERPATH . 'includes/gallery/gallery.php');
}
add_action('wp_enqueue_scripts', 'multidealer_add_files');
function multidealer_add_files()
{
    wp_enqueue_script("jquery");
    wp_enqueue_style('show-room', MULTIDEALERURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', MULTIDEALERURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', MULTIDEALERURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearchwidget', MULTIDEALERURL . 'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', MULTIDEALERURL .
        'includes/gallery/css/flexslider.css');
    wp_enqueue_style('pluginStyleGeneral5', MULTIDEALERURL .
        'includes/contact-form/css/multi-contact-form.css');
    wp_register_style('jqueryuiSkin', MULTIDEALERURL . 'assets/jquery/jqueryui.css', array(), '1.12.1');
    wp_enqueue_style('jqueryuiSkin');
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('wp-color-picker');

    wp_enqueue_style('wp-color-picker');

    // do not remove
    wp_enqueue_style('help-multidealer', MULTIDEALERURL . '/dashboard/css/help.css');
    wp_enqueue_style('pointer3-multidealer', MULTIDEALERURL . '/dashboard/css/pointer.css');
}

function multidealer_enqueue_scripts()
{
    // do not remove
    wp_enqueue_style('bill-help-multidealer', MULTIDEALERURL . '/dashboard/css/help.css');
    wp_enqueue_style('bill-pointer3', MULTIDEALERURL . '/dashboard/css/pointer.css');
}
// do not remove
add_action('admin_init', 'multidealer_enqueue_scripts');




add_action('admin_enqueue_scripts', 'multidealer_enqueue_admin_scripts');
function multidealer_enqueue_admin_scripts()
{
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
}


function multidealer_activated()
{
    $w = update_option('multidealer_activated', '1');
    if (!$w)
        add_option('multidealer_activated', '1');
    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('multidealer_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('multidealer_recipientEmail', $admin_email);
        if (!$w)
            add_option('multidealer_recipientEmail', $admin_email);
    }
}
register_activation_hook(__file__, 'multidealer_activated');
/*
function multidealer_localization_init()
{
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('multidealer', false, $path);
} 
    */
function multidealer_load_bill_stuff()
{
    wp_enqueue_script('jquery-ui-core');
}
add_action('wp_loaded', 'multidealer_load_bill_stuff');

/*
function multidealer_load_feedback()
{
    // (Javascript) TypeError PROBLEM DESCRIPTION: undefined is not an object (evaluating \'urlsite.includes\') SCRIPT NAME: feedback.js LINE: 48 

    if(is_admin())
    {
        require_once (MULTIDEALERPATH . "includes/feedback/feedback.php");
        if( get_option('bill_last_feedback', '') != '1')
          require_once (MULTIDEALERPATH . "includes/feedback/feedback-last.php");
     }  
}
add_action( 'wp_loaded', 'multidealer_load_feedback' );
*/



function multidealer_load_activate()
{
    if ($multidealer_is_admin) {
        //   require_once (MULTIDEALERPATH . 'includes/feedback/activated-manager.php');
    }
}
add_action('admin_menu', 'multidealer_add_menu_gopro');
//////////////////////////  CUSTOMIZER PREVIEW  //
function multidealer_add_custom_submenu_page()
{
    add_theme_page(
        'Multi_Dealer_Designer', // Page title
        'MultiDealer Designer',  // Menu title
        'manage_options',  // Capability required to access the page
        'Multi_Dealer_Designer', // Unique identifier for the page
        '__return_null' // Callback function to display
    );
}
add_action('admin_menu', 'multidealer_add_custom_submenu_page');
//add_submenu_page('multi_dealer_plugin', 'Designer', 'MultiDealer Designer', 'manage_options', 'md-designer', 'multidealer_designer_callback',7);
function multidealer_plugin_customize_preview_js()
{
    $file =  MULTIDEALERURL . 'assets/js/multidealer_customizer-preview.js';
    $r = wp_enqueue_script(
        "my-customize-preview222",
        $file,
        array('jquery'),
        '1.99'
    );
    // Localize script and pass the variable
    $multidealer_previewUrl =  home_url() . '/' . multidealer_find_single_url();
    wp_localize_script('my-customize-preview222', 'multidealer_my_data', array(
        'multidealer_previewUrl' => $multidealer_previewUrl,
    ));
}
add_action('customize_preview_init', 'multidealer_plugin_customize_preview_js');
function multidealer_customize_controls_js()
{
    $file =  MULTIDEALERURL . 'js/multidealer_customize_events.js';
    wp_enqueue_script(
        "my-customize-events222",
        MULTIDEALERURL . 'assets/js/multidealer_customize_events.js',
        array('jquery'),
        '1.99'
    );
    $file =  MULTIDEALERURL . 'assets/js/multidealer_customize-controls.js';
    wp_enqueue_script(
        "my-customize-controls222",
        MULTIDEALERURL . 'assets/js/multidealer_customize-controls.js',
        array('customize-preview'),
        '1.99'
    );
    // Localize script and pass the variable
    $multidealer_previewUrl =  home_url() . '/' . multidealer_find_single_url();
    wp_localize_script('my-customize-controls222', 'multidealer_my_data', array(
        'multidealer_previewUrl' => $multidealer_previewUrl,
    ));
}
add_action('admin_enqueue_scripts', 'multidealer_customize_controls_js');
///////////////////////////// find single url
function multidealer_find_single_url()
{
    global $wp;
    // global $query;
    global $wp_query;
    global $wp_the_query;
    $args = array(
        'post_type' => 'products'
    );
    wp_reset_query();
    $car_query = new WP_Query($args);
    $car_posts = get_posts($args);
    if (!isset($car_posts[0]->ID))
        return '-1';
    $post_name = basename(get_permalink($car_posts[0]->ID));
    return $post_name;
}
function multidealer_last()
{
    include_once MULTIDEALERPATH . '/includes/customizer/customizer.php';
    include_once  MULTIDEALERPATH  . '/includes/customizer/public.php';
}
add_action('plugins_loaded', 'multidealer_last');
//////////////////////////          END CUSTOMIZER PREVIEW  //

function multidealer_localization_init()
{
    $path = MULTIDEALERPATH . 'language/';
    $locale = apply_filters('plugin_locale', determine_locale(), 'multidealer');

    // Full path of the specific translation file (e.g., es_AR.mo)
    $specific_translation_path = $path . "multidealer-$locale.mo";
    $specific_translation_loaded = false;

    // Check if the specific translation file exists and try to load it
    if (file_exists($specific_translation_path)) {
        $specific_translation_loaded = load_textdomain('multidealer', $specific_translation_path);
    }

    // List of languages that should have a fallback to a specific locale
    $fallback_locales = [
        'de' => 'de_DE',  // German
        'fr' => 'fr_FR',  // French
        'it' => 'it_IT',  // Italian
        'es' => 'es_ES',  // Spanish
        'pt' => 'pt_BR',  // Portuguese (fallback to Brazil)
        'nl' => 'nl_NL'   // Dutch (fallback to Netherlands)
    ];

    // If the specific translation was not loaded, try to fallback to the generic version
    if (!$specific_translation_loaded) {
        $language = explode('_', $locale)[0];  // Get only the language code, ignoring the country (e.g., es from es_AR)

        if (array_key_exists($language, $fallback_locales)) {
            // Full path of the generic fallback translation file (e.g., es_ES.mo)
            $fallback_translation_path = $path . "multidealer-{$fallback_locales[$language]}.mo";

            // Check if the fallback generic file exists and try to load it
            if (file_exists($fallback_translation_path)) {
                load_textdomain('multidealer', $fallback_translation_path);
            }
        }
    }

    // Load the plugin
    load_plugin_textdomain('multidealer', false, plugin_basename(MULTIDEALERPATH) . '/language/');
}
function multidealer_check_wordpress_logged_in_cookie()
{
    // Percorre todos os cookies definidos
    foreach ($_COOKIE as $key => $value) {
        // Verifica se algum cookie começa com 'wordpress_logged_in_'
        if (strpos($key, 'wordpress_logged_in_') === 0) {
            // Cookie encontrado
            return true;
        }
    }
    // Cookie não encontrado
    return false;
}

function multidealer_new_more_plugins()
{
    $plugin = new multidealer_Bill_show_more_plugins();
    $plugin->bill_show_plugins();
}

function multidealer_bill_more()
{
    global $multidealer_is_admin;
    //if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($multidealer_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_show_more_plugins") !== false) {
                //return;
            }
        }
        require_once dirname(__FILE__) . "/includes/more-tools/class_bill_more.php";
    }
    // }
}
add_action("init", "multidealer_bill_more", 5);

// -------------------------------------


function multidealer_bill_hooking_diagnose()
{
    global $multidealer_is_admin;
    // if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($multidealer_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_Diagnose") !== false) {
                return;
            }
        }
        $plugin_slug = 'multidealer';
        $plugin_text_domain = $plugin_slug;
        $notification_url = "https://wpmemory.com/fix-low-memory-limit/";
        $notification_url2 =
            "https://wptoolsplugin.com/site-language-error-can-crash-your-site/";
        require_once dirname(__FILE__) . "/includes/diagnose/class_bill_diagnose.php";
    }
    // } 
}
add_action("init", "multidealer_bill_hooking_diagnose", 10);
//
//



function multidealer_bill_hooking_catch_errors()
{
    global $multidealer_plugin_slug;
    global $multidealer_is_admin;

    $declared_classes = get_declared_classes();
    foreach ($declared_classes as $class_name) {
        if (strpos($class_name, "bill_catch_errors") !== false) {
            return;
        }
    }
    $multidealer_plugin_slug = 'multidealer';
    require_once dirname(__FILE__) . "/includes/catch-errors/class_bill_catch_errors.php";
}
add_action("init", "multidealer_bill_hooking_catch_errors", 15);


// ------------------------
