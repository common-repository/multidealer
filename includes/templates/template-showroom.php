<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function multidealer_show_products($atts)
{
  $output = '<div id="multi_dealer_content">';    
  if (isset($atts['onlybar']))
      {
         $output .= multidealer_search(1);
         $output .= '</div'; 
         return $output;
       }
    if (isset($atts['option'])) {
        $multi_dealer_option = trim($atts['option']);
    } else {
        $multi_dealer_option = 'DESC';
    }
    if (isset($atts['pagination'])) {
        $multi_dealer_pagination = trim($atts['pagination']);
    } else {
        $multi_dealer_pagination = 'yes';
    }
    if (isset($atts['search'])) {
        $multi_dealer_show_search = trim($atts['search']);
    } else {
        $multi_dealer_show_search = 'yes';
    }
    if (isset($atts['option'])) {
        $multidealer_option = trim($atts['option']);
    } else {
        $multidealer_option = '';
    }
    if (!isset($_GET['submit'])) {
        $_GET['submit'] = '';
    } else
        $submit = sanitize_text_field($_GET['submit']);
    if (isset($_GET['multidealer_postNumber'])) {
        $multidealer_postNumber = sanitize_text_field($_GET['multidealer_postNumber']);
    }
    if (isset($atts['max'])) {
        $multidealer_postNumber = trim($atts['max']);
    }
    // orderby
    if (isset($atts['orderby']))
        $orderby = trim($atts['orderby']);
    else
        $orderby = '';
    if (!isset($multidealer_postNumber)) {
        $multidealer_postNumber = get_option('multidealer_quantity', 6);
    }
    if (empty($multidealer_postNumber)) {
        $multidealer_postNumber = get_option('multidealer_quantity', 6);
    }
    if ($multi_dealer_show_search == 'yes')
        $output .= multidealer_search(1);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = multidealer_get_page();
    global $wp_query;
    wp_reset_query();
            $args = array(
                'post_type' => 'products',
                'showposts' => $multidealer_postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'ASC');
        // orderby
        if (!empty($orderby)) {
            $args['orderby'] = 'meta_value';
            $args['meta_type'] = 'NUMERIC';
            if ($orderby == 'price_high') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'price_low') {
                $args['meta_key'] = 'product-price';
                $args['order'] = 'ASC';
            }
            if ($orderby == 'year_high') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'year_low') {
                $args['meta_key'] = 'product-year';
                $args['order'] = 'ASC';
            }
        } else {
            $args['orderby'] = 'date';
            $args[] = 'ASC';
        }
    $wp_query = new WP_Query($args);
    $qposts = $wp_query->post_count;
    $ctd = 0;



    $output .= '<div class="multiGallery">';
    $output .= '<div class="multidealer_container">';



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
      

        $output .= '<div>';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="multidealer_gallery_2016">';
        $output .= '<img class="multidealer_caption_img" src="' . $thumb . '" alt="' .
            get_the_title() . '" />';
        $output .= '<div class="multidealer_caption_text">';
        
        //$output .= ($price <> '' ? multidealer_currency() . $price : __('Call for Price',
        //    'multidealer'));
        
        $output .= $price;   
        // $output .= ($price <> '' ? '<br />' : '');
        $output .= '<br />';
        $output .= ($year <> '' ? __('Year', 'multidealer') . ': ' . $year . '<br />' : '');
        $output .= '</div>';
        $output .= '<div class="multiTitle">' . get_the_title() . '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        if ($ctd < $qposts) {
            if ($ctd % 3 == 0) {
                $output .= '</div>';
                $output .= '<div class="multidealer_container">';
            }
        }
    endwhile;   
    $output .= '</div>'; 
    $output .= '<br/> <br/>';  






    if ($multi_dealer_pagination == 'yes') {
        $output .= '<div class="multi_dealer_navigation">';
        $output .= '';
        ob_start();
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('Back', 'multidealer'),
            'next_text' => __('Onward', 'multidealer'),
            ));
        // echo multidealer_paginate_links();
 //     multidealer_paginate();
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    wp_reset_query();
    if ($qposts < 1) {
        $output .= '<h4>' . __('Not Found !', 'multidealer') . '</h4>';
    }
    return $output;
}
add_shortcode('multi_dealer', 'multidealer_show_products'); 
/*
function multidealer_add_query_vars_filter( $vars ){
  $vars[] = "page";
  return $vars;
}
add_filter( 'query_vars', 'multidealer_add_query_vars_filter' );
function multidealer_paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'list',
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;'
		);
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo multidealer_paginate_links( $pagination );
}
*/ ?>