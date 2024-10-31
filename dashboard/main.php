<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly 
// ob_start();


define('MULTIDEALERHOMEURL', admin_url());
$multidealer_urlfields = MULTIDEALERHOMEURL . "/edit.php?post_type=multidealerfields";
$multidealer_urlproducts = MULTIDEALERHOMEURL . "/edit.php?post_type=products";
$multidealer_urllocations = MULTIDEALERHOMEURL . "/edit-tags.php?taxonomy=locations&post_type=products";
$multidealer_urlmakes =  MULTIDEALERHOMEURL . "/edit-tags.php?taxonomy=makes&post_type=products";
$multidealer_urlsettings = MULTIDEALERHOMEURL . "/options.php?page=md_settings";


add_action('admin_init', 'multidealer_settings_init');
add_action('admin_menu', 'multidealer_add_admin_menu');

/*
function multidealer_enqueue_scripts()
{
    wp_enqueue_style('bill-help-multidealer', MULTIDEALERURL . '/dashboard/css/help.css');
    wp_enqueue_style('bill-pointer3', MULTIDEALERURL . '/dashboard/css/pointer.css');
}
add_action('admin_init', 'multidealer_enqueue_scripts');
*/


function multidealer_fields_callback()
{
    global $multidealer_urlfields;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($multidealer_urlfields); ?>";
        -->
    </script>
<?php
}
function multidealer_products_callback()
{
    global $multidealer_urlproducts;
?>
    <script type="text/javascript">
        <!--
        // window.location  = "wp-admin/edit.php?post_type=products"; 
        window.location = "<?php echo esc_url($multidealer_urlproducts); ?>";
        -->
    </script>
<?php
}
function multidealer_makes_callback()
{
    global $multidealer_urlmakes;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($multidealer_urlmakes); ?>";
        -->
    </script>
<?php
}
function multidealer_locations_callback()
{
    global $multidealer_urllocations;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($multidealer_urllocations); ?>";
        -->
    </script>
<?php
}
function multidealer_settings_callback()
{
    global $multidealer_urlsettings;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($multidealer_urlsettings); ?>";
        -->
    </script>
<?php
}
function multidealer_add_admin_menu()
{
    //   global $vmtheme_hook;
    //   $vmtheme_hook = add_theme_page( 'For Dummies', 'For Dummies Help', 'manage_options', 'for_dummies', 'multidealer_options_page' );
    //   add_action('load-'.$vmtheme_hook, 'vmtheme_contextual_help');     
    global $menu;
    add_menu_page(
        'Multi Dealer',
        'Multi Dealer',
        'manage_options',
        'multi_dealer_plugin',
        'multidealer_options_page',
        MULTIDEALERURL . 'assets/images/multidealer.png',
        '30'
    );
    include_once(ABSPATH . 'wp-includes/pluggable.php');
    $link_our_new_CPT = urlencode('edit.php?post_type=multidealerfields');
    add_submenu_page('multi_dealer_plugin', 'Fields Table', __('Fields Table', 'multidealer'), 'manage_options', 'fields-table', 'multidealer_fields_callback');
    add_submenu_page('multi_dealer_plugin', 'Products Table',  __('Products Table', 'multidealer'), 'manage_options', 'products-table', 'multidealer_products_callback');
    add_submenu_page('multi_dealer_plugin', 'Makes', __('Makes', 'multidealer'), 'manage_options', 'md-makes', 'multidealer_makes_callback');
    add_submenu_page('multi_dealer_plugin', 'Locations', __('Locations', 'multidealer'), 'manage_options', 'md-locations', 'multidealer_locations_callback');
    add_submenu_page('multi_dealer_plugin', 'Settings',  __('Settings', 'multidealer'), 'manage_options', 'md-settings', 'multidealer_settings_callback');
    add_submenu_page('multi_dealer_plugin', 'Designer', 'MultiDealer Designer', 'manage_options', 'md-designer', 'multidealer_designer_callback', 7);
}

function multidealer_designer_callback()
{
    if (strpos(wp_get_referer(), 'bill_designer') == false) {
        $multidealer_temp = home_url() . '/wp-admin/customize.php?autofocus[panel]=bill_designer';
    } else {
        $multidealer_temp = home_url() . '/wp-admin/index.php?customize_changeset_uuid=';
    }
    echo '<script>';
    echo 'window.location.href = "' . esc_url($multidealer_temp) . '";';
    echo '</script>';
}

function multidealer_settings_init()
{
    register_setting('multidealer', 'multidealer_settings');
}
function multidealer_options_page()
{
    global $multidealer_activated, $multidealer_update_theme;
    $wpversion = get_bloginfo('version');
    $current_user = wp_get_current_user();
    $plugin = plugin_basename(__FILE__);
    $email = $current_user->user_email;
    $username =  trim($current_user->user_firstname);
    $user = $current_user->user_login;
    $user_display = trim($current_user->display_name);
    if (empty($username))
        $username = $user;
    if (empty($username))
        $username = $user_display;
    $theme = wp_get_theme();
    $themeversion = $theme->version;
    $memory['limit'] = (int) ini_get('memory_limit');
    $memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
    $memory['wplimit'] =  WP_MEMORY_LIMIT;
?>
    <!-- Begin Page -->
    <div id="multidealer-theme-help-wrapper">
        <div id="multidealer-not-activated"></div>
        <div id="multidealer-logo">
            <img alt="logo" src="<?php echo esc_url(MULTIDEALERIMAGES); ?>logosmall.png" />
        </div>


        <div id="multidealer-social">
            <a href="http://multidealerplugin.com/share/"><img alt="social bar" src="<?php echo esc_url(MULTIDEALERIMAGES); ?>/social-bar.png" width="250px" /></a>
        </div>

        <div id="multidealer_help_title">
            <?php esc_attr_e("Help and Support Page", "multidealer"); ?>
        </div>





        <?php
        if (isset($_GET['tab']))
            $active_tab = sanitize_text_field($_GET['tab']);
        else
            $active_tab = 'dashboard';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=multi_dealer_plugin&tab=memory&tab=dashboard" class="nav-tab">Dashboard</a>
            <a href="?page=multi_dealer_plugin&tab=memory" class="nav-tab">Memory Check Up</a>
            <a href="?page=multi_dealer_plugin&tab=tools" class="nav-tab">More Tools</a>
        </h2>


    <?php


    echo '<div id="multidealer-dashboard-wrap">';
    echo '<div id="multidealer-dashboard-left">';


    if ($active_tab == 'memory') {
        require_once(MULTIDEALERPATH . 'dashboard/memory.php');
    } elseif ($active_tab == "tools") {
        //require_once(MULTIDEALERPATH . 'dashboard/more.php');
        $plugin = new multidealer_Bill_show_more_plugins();
        $plugin->bill_show_plugins();
    } else {
        require_once(MULTIDEALERPATH . 'dashboard/dashboard.php');
    }

    echo '</div> <!-- "multidealer-dashboard-left"> -->';
    echo '<div id="multidealer-dashboard-right">';
    echo '<div id="multidealer-containerright-dashboard">';
    require_once(MULTIDEALERPATH . 'dashboard/mybanners.php');
    echo '</div>';
    echo '</div> <!-- "multidealer-dashboard-right"> -->';
    echo '</div> <!-- "multidealer-dashboard-wrap"> -->';




    echo '</div> <!-- "multidealer-theme_help-wrapper"> -->';
} // end Function multidealer_options_page
require_once(ABSPATH . 'wp-admin/includes/screen.php');
// ob_end_clean();
include_once(ABSPATH . 'wp-includes/pluggable.php');
    ?>