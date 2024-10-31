<?php

/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function multidealer_findglooglemap()
{
    global $wpdb;
    $argsfindfields = array(
        'post_status' => 'publish',
        'post_type' => 'multidealerfields'
    );
    query_posts($argsfindfields);
    $afields = array();
    $afieldsid = array();
    $multidealer_Mapfield_name = '';
    while (have_posts()) : the_post();
        $post_id = esc_attr(get_the_ID());
        $multidealer_Mapfield_name = get_the_title($post_id);
        $field_type = esc_attr(get_post_meta($post_id, 'field-typefield', true));
        if ($field_type  == 'googlemap') {
            if (!empty($multidealer_Mapfield_name))
                return 'product-' . $multidealer_Mapfield_name;
        }

    endwhile;

    // if (!empty ($multidealer_Mapfield_name) )
    //    return $isgooglemap = 'product-'.$multidealer_Mapfield_name;
    // else
    return '';
}
function multidealer_get_fields($type)
{
    global $wpdb;
    if (!function_exists('get_userdata()')) {
        include(ABSPATH . "/wp-includes/pluggable.php");
    }
    if ($type == 'search') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'multidealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'field-searchbar',
                    'value' => '1'
                )
            )
        );
    } elseif ($type == 'all') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'multidealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );
    } elseif ($type == 'widget') {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'multidealerfields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'field-searchwidget',
                    'value' => '1'
                )
            )
        );
    }
    query_posts($args);
    $afields = array();
    $afieldsid = array();
    while (have_posts()) : the_post();
        $afieldsid[] = esc_attr(get_the_ID());
    endwhile;

    ob_start();
    if (isset($GLOBALS['wp_the_query']))
        wp_reset_query();
    ob_end_clean();

    return $afieldsid;
} // end Function

add_action('wp_loaded', 'multi_get_makes');
function multi_get_makes()
{
    global $wpdb;
    $multimake = array();
    $args = array(
        'taxonomy'               => 'makes',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    foreach ($the_query->get_terms() as $term) {
        $multimake[] = $term->name;
    }
    $qtypes = count($multimake);
    if ($qtypes < 1) {
        $atypes = array("Dodge", "Ford", "Mercedes", "Other");
        $parent_term = term_exists('makes', 'cars'); // array is returned if taxonomy is given
        // $parent_term_id = $parent_term['term_id']; // get numeric term id
        for ($i = 0; $i < 4; $i++) {
            wp_insert_term(
                $atypes[$i],
                'makes',
                array(
                    'slug' =>  $atypes[$i],
                )
            );
        }
        $multimake = $atypes;
    }
    return $multimake;
}

function multidealer_get_meta($post_id)
{
    $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',
        'field-order',
        'field-name'
    );
    $tot = count($fields);
    for ($i = 0; $i < $tot; $i++) {
        $field_value[$i] = esc_attr(get_post_meta($post_id, $fields[$i], true));
    }
    $field_value[$tot - 1] = esc_attr(get_the_title($post_id));
    return $field_value;
}
function multidealer_get_types()
{
    global $wpdb;
    $productmake = array();
    $args = array(
        'taxonomy'               => 'makes',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    $productmake = array();
    foreach ($the_query->get_terms() as $term) {
        $productmake[] = $term->name;
    }
    return $productmake;
}
function multidealer_get_max()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-price',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-price', true);
        if (!empty($x)) {
            $x = (int)$x;
            if (is_int($x)) {
                $x = ($x) * 1.2;
                $x = round($x, 0, PHP_ROUND_HALF_EVEN);
                //return $x;
            }
        }
        if ($x < 1)
            return '100000';
        else
            return $x;
    }
}
add_action('wp_loaded', 'multidealer_get_types');
function multidealer_currency()
{

    /*
    $currencies = array(
        'AED'  => __( 'United Arab Emirates Dirham (&#1583;.&#1573;)', 'multidealer' ),
        'AFN'  => __( 'Afghan Afghani (&#1547;)', 'multidealer' ),
        'AOA'  => __( 'Angolan Kwanza', 'multidealer' ),
        'ARS'  => __( 'Argentine Pesos (&#36;)', 'multidealer' ),
        'AUD'  => __( 'Australian Dollars (&#36;)', 'multidealer' ),
        'BRL'  => __( 'Brazilian Real (R&#36;)', 'multidealer' ),
        'BGN'  => __( 'Bulgarian Lev', 'multidealer' ),
        'CAD'  => __( 'Canadian Dollars (&#36;)', 'multidealer' ),
        'CHF'  => __( 'Swiss Franc', 'multidealer' ),
        'CNY'  => __( 'Chinese Yuan (&yen;)', 'multidealer' ),
        'CZK'  => __( 'Czech Koruna', 'multidealer' ),
        'DKK'  => __( 'Danish Krone', 'multidealer' ),
        'EUR'  => __( 'Euros (&euro;)', 'multidealer' ),
        'GBP'  => __( 'Pound Sterling (&pound;)', 'multidealer' ),
        'HKD'  => __( 'Hong Kong Dollar (&#36;)', 'multidealer' ),
        'HRK'  => __( 'Croatian Kuna', 'multidealer' ),
        'HUF'  => __( 'Hungarian Forint', 'multidealer' ),
        'IDR'  => __( 'Indonesian Rupiah (Rp)', 'multidealer' ),
        'ILS'  => __( 'Israeli Shekel (&#8362;)', 'multidealer' ),
        'INR'  => __( 'Indian Rupee (&#8377;)', 'multidealer' ),
        'JPY'  => __( 'Japanese Yen (&yen;)', 'multidealer' ),
        'KRW'  => __( 'South Korean Won (&#8361;)', 'multidealer' ),
        'MXN'  => __( 'Mexican Peso (&#36;)', 'multidealer' ),
        'MYR'  => __( 'Malaysian Ringgits', 'multidealer' ),
        'NOK'  => __( 'Norwegian Krone', 'multidealer' ),
        'NZD'  => __( 'New Zealand Dollar (&#36;)', 'multidealer' ),
        'PHP'  => __( 'Philippine Pesos', 'multidealer' ),
        'PLN'  => __( 'Polish Zloty', 'multidealer' ),
        'PKR'  => __( 'Pakistani Rupee (₨)', 'multidealer' ),
        'RON'  => __( 'Romanian Leu', 'multidealer' ),
        'RUB'  => __( 'Russian Rubles', 'multidealer' ),
        'SAR'  => __( 'Saudi Riyal (&#65020;)', 'multidealer' ),
        'SEK'  => __( 'Swedish Krona', 'multidealer' ),
        'SGD'  => __( 'Singapore Dollar (&#36;)', 'multidealer' ),
        'THB'  => __( 'Thai Baht (&#3647;)', 'multidealer' ),
        'TRY'  => __( 'Turkish Lira (&#8378;)', 'multidealer' ),
        'TWD'  => __( 'Taiwan New Dollars', 'multidealer' ),
        'USD'  => __( 'US Dollars (&#36;)', 'multidealer' ),
        'VND'  => __( 'Vietnamese Dong (&#8363;)', 'multidealer' ),
        'YEN'  => __( 'Yen (&yen;)', 'real-estate-right-now' ),
        'ZAR'  => __( 'South African Rand', 'multidealer' ),
    );
    */



    $currency =  get_option('MultiDealercurrency');

    // if(!function_exists('get_currency_symbol')){
    //     function get_currency_symbol($currency) {
    $currencies = array(
        'AED'  => '&#1583;.&#1573;',
        'AFN'  => '&#1547;',
        'AOA'  => 'Kz',
        'ARS'  => '&#36;',
        'AUD'  => '&#36;',
        'BRL'  => 'R&#36;',
        'BGN'  => 'лв',
        'CAD'  => '&#36;',
        'CHF'  => 'CHF',
        'CNY'  => '&yen;',
        'CZK'  => 'Kč',
        'DKK'  => 'kr',
        'EUR'  => '&euro;',
        'GBP'  => '&pound;',
        'HKD'  => '&#36;',
        'HRK'  => 'kn',
        'HUF'  => 'Ft',
        'IDR'  => 'Rp',
        'ILS'  => '&#8362;',
        'INR'  => '&#8377;',
        'JPY'  => '&yen;',
        'KRW'  => '&#8361;',
        'MXN'  => '&#36;',
        'MYR'  => 'RM',
        'NOK'  => 'kr',
        'NZD'  => '&#36;',
        'PHP'  => '&#8369;',
        'PLN'  => 'zł',
        'PKR'  => '₨',
        'RON'  => 'lei',
        'RUB'  => '&#8381;',
        'SAR'  => '&#65020;',
        'SEK'  => 'kr',
        'SGD'  => '&#36;',
        'THB'  => '&#3647;',
        'TRY'  => '&#8378;',
        'TWD'  => 'NT$',
        'USD'  => '&#36;',
        'VND'  => '&#8363;',
        'ZAR'  => 'R',
        // Adicione outros símbolos de moeda conforme necessário
    );

    // Verifique se a moeda está na array e retorne o símbolo correspondente
    if (array_key_exists($currency, $currencies)) {
        return $currencies[$currency];
    } else {
        return '&curren;'; // Retorna vazio se a moeda não estiver na array
    }
    //     }
    // }


}


function multidealer_localization_init_fail()
{
    echo '<div class="error notice">
                     <br />
                     multidealerPlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
}
function multidealer_Show_Notices1()
{
    echo '<div class="update-nag notice"><br />';
    echo 'Warning: Upload directory not found (MultiDealer Plugin). Enable debug for more info.';
    echo '<br /><br /></div>';
}
function multidealer_plugin_was_activated()
{
    echo '<div class="updated"><p>';


    $bd_msg = '<img src="' . MULTIDEALERURL . 'assets/images/infox350.png" />';
    $bd_msg .= '<h2>MultiDealer Plugin was activated! </h2>';
    $bd_msg .= '<h3>For details and help, take a look at Multi Dealer Dashboard at your left menu <br />';
    $bd_url = '  <a class="button button-primary" href="admin.php?page=multi_dealer_plugin">or click here</a>';
    $bd_msg .=  $bd_url;
    echo wp_kses_post($bd_msg);


    echo "</p></h3></div>";
    $multidealer_installed = trim(get_option('multidealer_installed', ''));
    if (empty($multidealer_installed)) {
        add_option('multidealer_installed', time());
        update_option('multidealer_installed', time());
    }
}
if (is_admin()) {
    if (get_option('multidealer_activated', '0') == '1') {
        add_action('admin_notices', 'multidealer_plugin_was_activated');
        $r =  update_option('multidealer_activated', '0');
        if (! $r)
            add_option('multidealer_activated', '0');
    }
}
if (!function_exists('multidealer_write_log')) {
    function multidealer_write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}
add_filter('plugin_row_meta', 'multidealer_custom_plugin_row_meta', 10, 2);
function multidealer_custom_plugin_row_meta($links, $file)
{
    if (strpos($file, 'multidealer.php') !== false) {
        $new_links = array(
            'OnLine Guide' => '<a href="http://multidealerplugin.com/guide/" target="_blank">OnLine Guide</a>',
            'Pro' => '<a href="https://siterightaway.net/multi-dealer-premium-plugin/" target="_blank"><b><font color="#FF6600">Go Pro</font></b></a>'
        );
        $links = array_merge($links, $new_links);
    }
    return $links;
}
function multidealer_get_page()
{
    $page = 1;
    $url = sanitize_text_field($_SERVER['REQUEST_URI']);
    $pieces = explode("/", $url);
    for ($i = 0; $i < count($pieces); $i++) {
        if ($pieces[$i] == 'page' and ($i + 1) <  count($pieces)) {
            $page = $pieces[$i + 1];
            if (is_numeric($page))
                return $page;
        }
    }
    return $page;
}
function multidealer_wrong_permalink()
{
    echo '<div class="notice notice-warning">
                     <br />
                     Multi Dealer Plugin: Wrong Permalink settings !
                     <br />
                     Please, fix it to avoid 404 error page.
                     <br />
                     To correct, just follow this steps:
                     <br />
                     Dashboard => Settings => Permalinks => Post Name (check)
                     <br />  
                     Click Save Changes
                     <br /><br />
                     </div>';
}
$multidealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
if (strpos($multidealerurl, '/options-permalink.php') === false) {
    $permalinkopt  = get_option('permalink_structure');
    if ($permalinkopt != '/%postname%/')
        add_action('admin_notices', 'multidealer_wrong_permalink');
}
function multidealer_change_note_submenu_order($menu_ord)
{
    global $submenu;

    function multidealer_str_replace_json($search, $replace, $subject)
    {
        return json_decode(str_replace($search, $replace, json_encode($subject)), true);
    }
    $key = 'Multi Dealer';
    $val =  __('Dashboard', 'multidealer');
    $submenu = multidealer_str_replace_json($key, $val, $submenu);
}
add_filter('custom_menu_order', 'multidealer_change_note_submenu_order');

function multidealer_gopro_callback()
{
    $urlgopro = "http://multidealerplugin.com/premium/";
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($urlgopro); ?>";
        -->
    </script>
<?php
}
function multidealer_add_menu_gopro()
{
    $sbb_gopro_page = add_submenu_page(
        'multi_dealer_plugin', // $parent_slug
        'Go Pro', // string $page_title
        '<font color="#FF6600">Go Pro</font>', // string $menu_title
        'manage_options', // string $capability
        'multidealer_my-custom-submenu-page3',
        'multidealer_gopro_callback'
    );
}

function multidealer_check_memory()
{
    global $multidealer_memory;
    $multidealer_memory['limit'] = (int) ini_get('memory_limit');
    $multidealer_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
    if (!defined("WP_MEMORY_LIMIT")) {
        $multidealer_memory['msg_type'] = 'notok';
        return;
    }
    $multidealer_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT);
    if ($multidealer_memory['wp_limit'] > 9999999)
        $multidealer_memory['wp_limit'] = ($multidealer_memory['wp_limit'] / 1024) / 1024;
    if (!is_numeric($multidealer_memory['usage'])) {
        $multidealer_memory['msg_type'] = 'notok';
        return;
    }
    if (!is_numeric($multidealer_memory['limit'])) {
        $multidealer_memory['msg_type'] = 'notok';
        return;
    }
    if ($multidealer_memory['usage'] < 1) {
        $multidealer_memory['msg_type'] = 'notok';
        return;
    }
    $wplimit = $multidealer_memory['wp_limit'];
    $wplimit = substr($wplimit, 0, strlen($wplimit) - 1);
    $multidealer_memory['wp_limit'] = $wplimit;
    $multidealer_memory['percent'] = $multidealer_memory['usage'] / $multidealer_memory['wp_limit'];
    $multidealer_memory['color'] = 'font-weight:normal;';
    if ($multidealer_memory['percent'] > .7) $multidealer_memory['color'] = 'font-weight:bold;color:#E66F00';
    if ($multidealer_memory['percent'] > .85) $multidealer_memory['color'] = 'font-weight:bold;color:red';
    $multidealer_memory['msg_type'] = 'ok';
    return $multidealer_memory;
}



?>