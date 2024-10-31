<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('wp_enqueue_scripts', 'multidealer_register_slider');
function multidealer_register_slider()
{
    wp_register_script('search-slider', MULTIDEALERURL .
        'includes/search/search_slider.js', array('jquery'), null, true);
    wp_enqueue_script('search-slider');
    wp_register_style('jqueryuiSkin', MULTIDEALERURL . 'assets/jquery/jqueryui.css',
        array(), '1.12.1');
    wp_enqueue_style('jqueryuiSkin');
}
function multidealer_search($is_show_room)
{
    // global $multidealer_postNumber, $wp, $post, $multidealer_page_id;
    global $multidealer_postNumber, $wp, $post, $multidealer_page_id, $multidealer_meta_make, $multidealer_meta_year;
    $my_title = __("Search", 'multidealer');
    if ($is_show_room == '0') // widget
        {
        $searchlabel = 'MultiDealer-search-label-widget';
        $selectboxmeta = 'MultiDealer-select-box-meta-widget';
        $selectbox = 'MultiDealer-select-box-widget';
        $inputbox = 'input-box-widget';
        $searchItem = 'searchItem-widget';
        $searchItem2 = 'searchItem2-widget';
        $MultiDealersubmitwrap = 'MultiDealer-submitBtn-widget';
        $multidealer_search_box = 'MultiDealer-search-box-widget';
        $current_page_url = esc_url(home_url() . '/multidealer_show_room_2/');
        $multidealer_search_type = 'search-widget';
        $afieldsId = multidealer_get_fields('widget');
        $multidealer_container_buttons_search = 'multidealer_container_buttons_search_widget';

    } elseif ($is_show_room == '1') // pag
    {
        $searchlabel = 'MultiDealer-search-label';
        $selectboxmeta = 'MultiDealer-select-box-meta';
        $selectbox = 'MultiDealer-select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem2';
        $MultiDealersubmitwrap = 'MultiDealer-submitBtn';
        $multidealer_search_box = 'MultiDealer-search-box';
        $current_page_url = home_url(esc_url(add_query_arg(null, null)));
        $multidealer_search_type = 'page';
        $afieldsId = multidealer_get_fields('search');
        $multidealer_container_buttons_search = 'multidealer_container_buttons_search';
    } elseif ($is_show_room == '2') // search result
    {
        $searchlabel = 'MultiDealer-search-label';
        $selectboxmeta = 'MultiDealer-select-box-meta';
        $selectbox = 'MultiDealer-select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem2';
        $MultiDealersubmitwrap = 'MultiDealer-submitBtn';
        $multidealer_search_box = 'MultiDealer-search-box';
        $current_page_url = esc_url(home_url() . '/multidealer_show_room_2/');
        $multidealer_search_type = 'search-widget';
        $afieldsId = multidealer_get_fields('search');
        $multidealer_container_buttons_search = 'multidealer_container_buttons_search';
    }
    //  $afieldsId = multidealer_get_fields('search');
    $totfields = count($afieldsId);
    $ametadataoptions = array();
    $output = '<div class="' . $multidealer_search_box . '">';
    $output .= '<div class="MultiDealer-search-cuore">';
    $output .= '<div class="MultiDealer-search-cuore-fields">';
    $output .= '<form method="get" id="searchform3" action="' . $current_page_url . '">';
    if (isset($multidealer_page_id)) {
        if ($multidealer_page_id <> '0') {
            $output .= '        <input type="hidden" name="page_id" value="' . $multidealer_page_id .
                '" />';
        }
    }
    $showsubmit = false;

    $output .= '<div class="'.$multidealer_container_buttons_search.'">';


        // Make
        if ((trim(get_option('multidealer_show_make', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('multidealer_widget_show_make', 'yes')) == 'yes' and $is_show_room ==
        0))
        {
        $showsubmit = true;
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Make', 'multidealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= ' 
                            <select class="' . $selectboxmeta .
            '" name="meta_make">car
    							<option ' . (($multidealer_meta_make == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'multidealer') . ' </option>';
        $amakes = multi_get_makes();
        $qmakes = count($amakes);
        for ($i = 0; $i < $qmakes; $i++) {
          //  die('$make');
            $output .= '<option ' . (($multidealer_meta_make == trim($amakes[$i])) ? 'selected="selected"' :
                '') . '  value ="' . $amakes[$i] . '"> ' . $amakes[$i] . '</option>';
        }
        $output .= '</select></div>';
    }
   // end make
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = multidealer_get_meta($post_id);
        $field_value = array(
            'field_label', // 0
            'field_typefield', // 1
            'field_drop_options', // 2
            'field_searchbar', // 3
            'field_searchwidget', //4
            'field_rangemin', // 5
            'field_rangemax', //6
            'field_rangestep', // 7
            'field_slidemin', // 8
            'field_slidemax', // 9
            'field_slidestep', // 10
            'field_order', // 11
            'field_name'); // 12
        if (!empty($ametadata[0]))
            $search_label = $ametadata[0];
        else
            $search_label = $ametadata[12];
        $search_name = $ametadata[12];
        $meta = 'meta_'.$ametadata[12];
        if (!isset($_GET[$search_name])) {
            $_GET[$search_name] = '';
        }
       if (isset($_GET[$meta]))
          $multidealer_meta_con = trim(sanitize_text_field($_GET[$meta]));
       else
          $multidealer_meta_con = ' '; 
        $typefield = $ametadata[1];
        // Dropdown
        if ($typefield == 'dropdown') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $options = explode("\n", $ametadata[2]);
         //   $output .= '<option>All</option>';
            $output .= '<option value="All">'. __('All', 'multidealer') .'</option>';
            foreach ($options as $option) {
                $output .= '<option ';
                if(trim($multidealer_meta_con) == trim($option))
                  {
                    $output .= ' selected="selected" ';
                   }  
                $output .= '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown
        // Select Range
        if ($typefield == 'rangeselect') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $init = $ametadata[5];
            $max = $ametadata[6];
            $step = $ametadata[7];
            $options = array();
           // $output .= '<option>All</option>';
            $output .= '<option value="All">'. __('All', 'multidealer') .'</option>';
            for ($z = $init; $z <= $max; $z += $step) {
                $option = $z;
                $output .= '<option ' . ($multidealer_meta_con == $option ?
                        ' selected="selected"' : '') . '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown       
         // Checkbox
        if ($typefield == 'checkbox') {
            $showsubmit = true;
            if (isset($_GET[$meta]))
                $multidealer_meta_con = sanitize_text_field($_GET[$meta]);
            else
                $multidealer_meta_con = ' ';
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta .'" name="'.$meta.'">';
             //   $output .= '<option value = "All" ' . ($multidealer_meta_con == 'All' ? ' selected="selected"' : '') . '>All</option>';
                $output .= '<option value = "All" ' . ($multidealer_meta_con == 'All' ? ' selected="selected"' : '') . '>'. __("All", "multidealer") .'</option>';
            //    $output .= '<option value = "enabled" ' . ($multidealer_meta_con == "enabled"  ? ' selected="selected"' : '') . '>Yes</option>';
                $output .= '<option value = "enabled" ' . ($multidealer_meta_con == "enabled"  ? ' selected="selected"' : '') . '>'. __('Yes', 'multidealer') .'</option>';
           //     $output .= '<option value = "" ' . ($multidealer_meta_con == '' ? ' selected="selected"' : '') . '>No</option>';
                $output .= '<option value = "" ' . ($multidealer_meta_con == '' ? ' selected="selected"' : '') . '>'. __('No', 'multidealer') .'</option>';
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Checkbox
    } // end Loop  
      // Order by
    if ((trim(get_option('multidealer_show_orderby', 'yes')) == 'yes' and $is_show_room !=
        0) or (trim(get_option('multidealer_widget_show_orderby', 'yes')) == 'yes' and $is_show_room ==
        0)) {
        $showsubmit = true;
        if (isset($_GET['meta_order']))
            $multidealer_meta_order = sanitize_text_field($_GET['meta_order']);
        else
            $multidealer_meta_order = '';
        $multidealer_meta_order = sanitize_text_field($multidealer_meta_order);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Order By', 'multidealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta .
            '" name="meta_order" style="min-width: 120px;">
    							<option ' . (($multidealer_meta_order == '') ? 'selected="selected"' :
            '') . ' value =""> ' . __('Any', 'multidealer') . ' </option>
    							<option ' . (($multidealer_meta_order == 'year_high') ?
            'selected="selected"' : '') . '  value ="year_high"> ' . __('Year newest first',
            'multidealer') . '</option>
    							<option ' . (($multidealer_meta_order == 'year_low') ?
            'selected="selected"' : '') . '  value ="year_low"> ' . __('Year oldest first',
            'multidealer') . '</option>
    							<option ' . (($multidealer_meta_order == 'price_high') ?
            'selected="selected"' : '') . '  value ="price_high"> ' . __('Price higher first',
            'multidealer') . '</option>
    							<option ' . (($multidealer_meta_order == 'price_low') ?
            'selected="selected"' : '') . '  value ="price_low"> ' . __('Price lower first',
            'multidealer') . '</option>
    						</select>  
    					</div>';
    }      
    // end orderby   
    
    $output .= '</div>'; // end container buttons


        // Slider
         $showsubmit = true;  
         $max_car_value = multidealer_get_max();
        if ($is_show_room != '0') // no widget
           {
            $output .= '<div class="multidealer-price-slider">';
            $output .= '<span class="multidealerlabelprice">' . __('Price Range', 'multidealer') . ':</span>';
            $output .= '<input type="text" name="meta_price" id="meta_price" readonly>';
            // slider
            if ($is_show_room == '1')
                $output .= '<div id="multidealer_meta_price" class="multidealerslider" ></div>';
            else
                $output .= '<div id="multidealer_meta_price" class="multidealerslider" style="margin-top:7px;" ></div>';
            $output .= '<input type="hidden" name="meta_price_max" id="meta_price_max" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price']))
              $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min" id="choice_price_min" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max" id="choice_price_max" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
         }  // show room != 0 
        if ($is_show_room == '0') // widget
           {
            $output .= '<div class="multidealer-price-slider2">';
            $output .= '<span class="multidealerlabelprice2">' . __('Price', 'multidealer') . ':</span>';
            $output .= '<input type="text" name="meta_price2" id="meta_price2" readonly>';
                $output .= '<div id="multidealer_meta_price2" class="multidealerslider" "></div>';

            // $output .= '<input type="hidden" name="meta_price_max2" id="meta_price_max2" value="'.$max_car_value.'">';
            $output .= '<input type="hidden" name="meta_price_max2" id="meta_price_max2" value="'.$max_car_value.'">';
 
            if(isset($_GET['meta_price2']))
              $price = sanitize_text_field($_GET['meta_price2']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min2" id="choice_price_min2" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max2" id="choice_price_max2" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
         }  // show room = 0          
    // Submit
    if ($showsubmit) {
        $output .= '<div class="MultiDealer-submitBtnWrap">';
        $output .= '<input type="submit" name="submit" id="' . $MultiDealersubmitwrap .
            '" value=" ' . __('Search', 'multidealer') . '" />';
        $output .= '</div>';
        $output .= '<input type="hidden" name="multidealer_post_type" value="products" />';
        $output .= '<input type="hidden" name="multidealer_postNumber" value="' . $multidealer_postNumber .
            '" />';
        $output .= '<input type="hidden" name="multidealer_search_type" value="' . $multidealer_search_type .
            '" />';
    }
    $output .= '</form></div></div></div>  <!-- end of Basic -->';
    return $output;
} ?>
