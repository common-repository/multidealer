<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */ 
 if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
 ?>
<style type="text/css">
<!-- 
<?php if (get_option('sidebar_search_page_result', 'no') == 'yes') { ?>
    #secondary, .sidebar-container
    {
        display: none !important; 
    }
<?php } ?>
#main
{  width: 100%!important;
   position:  absolute;}
-->
</style>
<?php 
global $wp;
//global $query;
global $wp_query;
global $multidealer_meta_make;

$wp_query->is_404 = false;
get_header();
$output = '<div style="margin-top: 20px;">';
$output .= '<div id="multi_dealer_content">';
if (!isset($_GET['submit'])) {
    $_GET['submit'] = '';
} else
    $submit = sanitize_text_field($_GET['submit']);
if (isset($_GET['post_type'])) {
    $post_type = sanitize_text_field($_GET['post_type']);
}
if (isset($_GET['multidealer_postNumber'])) {
    $multidealer_postNumber = sanitize_text_field($_GET['multidealer_postNumber']);
}
if (empty($multidealer_postNumber)) {
    $multidealer_postNumber = get_option('multidealer_quantity', 6);
}
require_once (MULTIDEALERPATH . 'includes/search/search_get_par.php');

$output .= multidealer_search(2);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = multidealer_get_page();
//    else
//       echo 'p = '.$paged; 
if (isset($submit)) {
    $afieldsId = multidealer_get_fields('all');
    $totfields = count($afieldsId);
    $afilter = array();
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = multidealer_get_meta($post_id);
        $keyname = 'product-' . $ametadata[12];
        $metaname = 'meta_' . $ametadata[12];
        if (isset($_GET[$metaname])) {
            $keyval = trim(sanitize_text_field($_GET[$metaname]));
            if ($keyval != 'All' ) {
                 if ($ametadata[1] == 'checkbox') {
                    if ($keyval == 'enabled') {
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => $keyval,
                            'compare' => 'EXISTS');
                    }
                    else
                    {
                        echo esc_attr($keyname);
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => 'enabled',
                            'compare' => 'NOT EXISTS');                       
                    }
                } else // not checkbox
                {
                    if ( !empty($keyval))
                    {
                    $afilter[] = array(
                        'key' => $keyname,
                        // serialize())
                        'value' => $keyval,
                        'compare' => 'LIKE');
                    }
                }                
            }
            if(isset($_GET['meta_price']))  
               $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            if(isset($_GET['meta_price2']))  
               $price = sanitize_text_field($_GET['meta_price2']);
            if ($price != '') {
                $pos = strpos($price, '-');
                if ($pos !== false) {
                    $priceMin = trim(substr($price, 0, $pos - 1));
                    $priceMax = trim(substr($price, $pos + 1));
                    /*
                    $afilter[] = array(
                        'key' => 'product-price',
                        'value' => array($priceMin, $priceMax),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                        );
 */
                    $afilter[] = array(
                     // array(
                      'relation' => 'OR',
                       array(
                        'key' => 'product-price',
                        'value' => array($priceMin, $priceMax),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'),
                      array(
                        'key' => 'product-price',
                        'value' => '0',
                        'type' => 'numeric',  
                        'compare' => '='),
                   //   ), 
                  );   
                 }
            } // end meta_price
        }
    } // end Loop fields
    // Featured
    if (isset($_GET['meta_order']))
        $order = trim(sanitize_text_field($_GET['meta_order']));
    else
        $order = '';
    if (!empty($order)) {
        // $order =  $_GET['meta_order'];
        if ($order == 'price_high') {
            $wmetakey = 'product-price';
            $wmetaorder = 'DESC';
        }
        if ($order == 'price_low') {
            $wmetakey = 'product-price';
            $wmetaorder = 'ASC';
        }
        if ($order == 'year_high') {
            $wmetakey = 'product-year';
            $wmetaorder = 'DESC';
        }
        if ($order == 'year_low') {
            $wmetakey = 'product-year';
            $wmetaorder = 'ASC';
        }
    } // no order
    $args = array(
        'post_type' => 'products',
        'showposts' => $multidealer_postNumber,
        'paged' => $paged,
        );
    if (!empty($order)) {
        $args['orderby'] = 'meta_value';
        $args['meta_type'] = 'NUMERIC';
        $args['meta_key'] = $wmetakey;
        $args['order'] = $wmetaorder;
    }
    $args['meta_query'] = $afilter;

   if(!empty($make) and $make <> 'Any')
            {
               $args['tax_query'] = array(                
                               array(
                        'taxonomy' => 'makes',
                        'field' => 'name',
                        'terms' => $make,
                    ),
                 );
            }  

} else // submit
{
    $args = array(
        'post_type' => 'products',
        'showposts' => $multidealer_postNumber,
        'paged' => $paged,
        'order' => 'DESC');
}
// 
global $wp_query;
wp_reset_query();
$wp_query = new WP_Query($args);
$qposts = $wp_query->post_count;
// echo 'q posts: '.$qposts;
$ctd = 0;
$output .= '<div class="multiGallery">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    $ctd++;
    $price = get_post_meta(get_the_ID(), 'product-price', true);
          if ($price <> '' and $price != '0')
         {
            $price = number_format_i18n($price, 0);
            $price = multidealer_currency() . $price;
         }
         else
            $price =  __('Call for Price', 'multidealer');           
    $image_id = get_post_thumbnail_id();
    if (empty($image_id)) {
        $image = MULTIDEALERIMAGES . 'image-no-available-800x400_br.jpg';
        $image = str_replace("-", "", $image);
    } else {
        $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
        $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
    }
    $thumb = multidealer_theme_thumb($image, 400, 280, 'br'); // Crops from bottom right
    $year = get_post_meta(get_the_ID(), 'product-year', true);
    $output .= '<br /><div class="multidealer_container17">';
    $output .= '<div class="multidealer_gallery_17">';
    $output .= '<a class="nounderline" href="' . get_permalink() . '">';
    $output .= '<img class="multidealer_caption_img17" src="' . $thumb . '" />';
    $output .= '</a>';
    $output .= '</div>';
    $output .= '<div class="multiInfoRight17">';
    $output .= '<a class="nounderline" href="' . get_permalink() . '">';
    $output .= '<div class="multiTitle17">' . get_the_title() . '</div>';
    $output .= '</a>';
    $output .= '<div class="multiInforightText17">';
    $output .= '<div class="multiInforightbold">';
    $output .= $price  . '  -  ' ;
    $output .= ($year <> '' ? __('Year', 'multidealer') . ': ' . $year . '     ' :
        '');
    $output .= '</div>';
    $content_post = get_post(get_the_ID());
    $desc = sanitize_textarea_field($content_post->post_content);
    $desc = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $desc);
    $output .= '<br>';
    $output .= substr($desc, 0, 200);
    if (substr($desc, 200) <> '')
        $output .= '...';
    $output .= '</div>';

        $output .= '<input type="submit" class="multidealer_btn_view"';

        $output .= ' id="multidealer_btn_view-'.strval($ctd).'"';   
   
        $output .= ' onClick="location.href=\'' . get_permalink() . '\'"';
        $output .= ' value="' . __('View', 'multidealer') . '" />';
    $output .= '</div>';
    $output .= '</a>';
    $output .= '</div>';
endwhile;
$output .= '</div>';
ob_start();
the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('Back', 'multidealer'),
    'next_text' => __('Onward', 'multidealer'),
    ));
$output .= ob_get_contents();
ob_end_clean();
$output .= '</div>';
$output .= '</div>';
wp_reset_postdata();
wp_reset_query();
if ($qposts < 1) {
    $output .= '<h4>' . __('Not Found !', 'multidealer') . '</h4>';
}

$allowed_atts = array(
    'align'      => array(),
    'class'      => array(),
    'type'       => array(),
    'id'         => array(),
    'dir'        => array(),
    'lang'       => array(),
    'style'      => array(),
    'xml:lang'   => array(),
    'src'        => array(),
    'alt'        => array(),
    'href'       => array(),
    'rel'        => array(),
    'rev'        => array(),
    'target'     => array(),
    'novalidate' => array(),
    'type'       => array(),
    'value'      => array(),
    'name'       => array(),
    'tabindex'   => array(),
    'action'     => array(),
    'method'     => array(),
    'for'        => array(),
    'width'      => array(),
    'height'     => array(),
    'data'       => array(),
    'title'      => array(),

    'checked' => array(),
    'selected' => array(),
    "onclick" => array(),


);




$my_allowed['form'] = $allowed_atts;
$my_allowed['select'] = $allowed_atts;
// select options
$my_allowed['option'] = $allowed_atts;
$my_allowed['style'] = $allowed_atts;
$my_allowed['label'] = $allowed_atts;
$my_allowed['input'] = $allowed_atts;
$my_allowed['textarea'] = $allowed_atts;

//more...future...
$my_allowed['form']     = $allowed_atts;
$my_allowed['label']    = $allowed_atts;
$my_allowed['input']    = $allowed_atts;
$my_allowed['textarea'] = $allowed_atts;
$my_allowed['iframe']   = $allowed_atts;
$my_allowed['script']   = $allowed_atts;
$my_allowed['style']    = $allowed_atts;
$my_allowed['strong']   = $allowed_atts;
$my_allowed['small']    = $allowed_atts;
$my_allowed['table']    = $allowed_atts;
$my_allowed['span']     = $allowed_atts;
$my_allowed['abbr']     = $allowed_atts;
$my_allowed['code']     = $allowed_atts;
$my_allowed['pre']      = $allowed_atts;
$my_allowed['div']      = $allowed_atts;
$my_allowed['img']      = $allowed_atts;
$my_allowed['h1']       = $allowed_atts;
$my_allowed['h2']       = $allowed_atts;
$my_allowed['h3']       = $allowed_atts;
$my_allowed['h4']       = $allowed_atts;
$my_allowed['h5']       = $allowed_atts;
$my_allowed['h6']       = $allowed_atts;
$my_allowed['ol']       = $allowed_atts;
$my_allowed['ul']       = $allowed_atts;
$my_allowed['li']       = $allowed_atts;
$my_allowed['em']       = $allowed_atts;
$my_allowed['hr']       = $allowed_atts;
$my_allowed['br']       = $allowed_atts;
$my_allowed['tr']       = $allowed_atts;
$my_allowed['td']       = $allowed_atts;
$my_allowed['p']        = $allowed_atts;
$my_allowed['a']        = $allowed_atts;
$my_allowed['b']        = $allowed_atts;
$my_allowed['i']        = $allowed_atts;
 

echo wp_kses($output, $my_allowed);


// echo $output;


$registered_sidebars = wp_get_sidebars_widgets();
if (get_option('sidebar_search_page_result', 'no') == 'yes') {
    foreach ($registered_sidebars as $sidebar_name => $sidebar_widgets) {
        unregister_sidebar($sidebar_name);
    }
}
get_footer(); ?>