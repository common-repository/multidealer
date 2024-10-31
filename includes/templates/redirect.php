<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action("template_redirect", 'multidealer_template_redirect');
function multidealer_template_redirect()
{
    global $wp;
    //global $query;
    global $wp_query;
    if (isset($_GET['multidealer_search_type'])) {
        $multidealer_search_type = sanitize_text_field($_GET['multidealer_search_type']);
        $Multidealer_template_gallery = trim(get_option('multidealer_template_gallery',
            'yes'));        
        if ($Multidealer_template_gallery == 'yes')
            require_once (MULTIDEALERPATH . 'includes/templates/template-showroom2.php');
        else
            require_once (MULTIDEALERPATH . 'includes/templates/template-showroom3.php');
            die();
    }
   if (is_single()) {
        $multidealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
        if (strpos($multidealerurl, '/product/') === false)
            return;
        if (isset($wp->query_vars["post_type"])) {
            if ($wp->query_vars["post_type"] == "products") {
                if (have_posts()) {
                    include (MULTIDEALERPATH . 'includes/templates/template-single.php');
                    die();
                }
            }
        }
    }
}