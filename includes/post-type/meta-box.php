<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$multidealer_Mapfield_name = multidealer_findglooglemap();
$afields = array(
    array(
        'name' => __('Price', 'multidealer'),
        'desc' => __('No special characters here ("$" "," "."), the plugin will auto format the number.',
            'multidealer'),
        'id' => 'product-price',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => __('Year', 'multidealer'),
        'desc' => __('The year of the product. Only numbers, no point, no comma.',
            'multidealer'),
        'id' => 'product-year',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => __('Featured', 'multidealer'),
        'desc' => __('Mark to show up at Featured Widget.', 'multidealer'),
        'id' => 'product-featured',
        'type' => 'checkbox'));
$afieldsId = multidealer_get_fields('all');
$totfields = count($afieldsId);
$ametadataoptions = array();
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
        $label = $ametadata[0];
    else
        $label = $ametadata[12];
    if ($ametadata[1] == 'checkbox') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => $ametadata[1],
            );
    } elseif ($ametadata[1] == 'text') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => $ametadata[1],
            'default' => '');
    } elseif ($ametadata[1] == 'dropdown') {
        $arr = explode("\n", $ametadata[2]);
        $options = array();
        for ($z = 0; $z < count($arr); $z++) {
            // $options[$arr[$z]] = $arr[$z];
            $options[$z] = $arr[$z];
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {
        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];
        if(empty($init)) 
         $init = 0;
        $options = array();
        if (!empty($max) and !empty($step)) {
            for ($z = $init; $z <= $max; $z += $step) {
                $options[$z] = $z;
            }
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeslider') {
        $init = $ametadata[8];
        $max = $ametadata[9];
        $step = $ametadata[10];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {
        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
    } elseif ($ametadata[1] == 'googlemap') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'googlemap',
            'default' => '');
    }
}
$multidealer_meta_box['products'] = array(
    'id' => 'listing-details',
    'title' => __('Details', 'multidealer'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => $afields);
add_action('admin_menu', 'multidealer_listing_add_box');
update_option('multidealer_meta_boxes',$multidealer_meta_box);
function multidealer_listing_add_box()
{
    global $multidealer_meta_box;
    foreach ($multidealer_meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'multidealer_listing_format_box', $post_type,
            $value['context'], $value['priority']);
    }
}
function multidealer_listing_format_box()
{
    global $multidealer_meta_box, $multidealer_a_features, $post;
    wp_enqueue_style('meta', MULTIDEALERURL . 'includes/post-type/meta.css');
    echo '<input type="hidden" name="listing_meta_box_nonce" value="',
        esc_attr(wp_create_nonce(basename(__file__))), '" />';
    foreach ($multidealer_meta_box[$post->post_type]['fields'] as $field) {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $title = $field['name'];
        switch ($field['type']) {
            case 'text':
                echo '<div class="boxes-small">';

                //echo '<div class="box-label"><label for="' . $field['id'] . '">' . $title) =
               //     str_replace("_", " ", esc_attr($title)) . '</label></div>';

                  
$title = str_replace("_", " ", esc_attr($title));
echo '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_html($title) . '</label></div>';



                echo '<div class="box-content"><p>';
                echo '<input type="text" name="' . esc_attr($field['id']) . '" class="' . esc_attr($field['name']) .
                    '" id="' . esc_attr($field['id']) . '" value="' . esc_attr( ($meta ? $meta : $field['default']) ) .
                    '" size="30" style="width:97%" />' . '<br />' . esc_attr($field['desc']);
                echo '</div></div>';
                break;
                case 'select':
                    echo '<div class="boxes">' .
                         '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_html(str_replace("_", " ", $title)) . '</label></div>' .
                         '<div class="box-content"><p>';
                    echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" class="' . esc_attr($field['name']) . '">';
                    foreach ($field['options'] as $option100) {
                        echo '<option value="' . esc_attr($option100) . '"' . selected($meta, $option100, false) . '>' . esc_html($option100) . '</option>';
                    }
                    echo '</select>';
                    echo '<br />';
                    echo esc_html($field['desc']);
                    echo '</div></div>';
                    break;
                
                case 'checkbox':
                    echo '<div class="boxes-small">' .
                         '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_html(str_replace("_", " ", $title)) . '</label></div>' .
                         '<div class="box-content"><p>';
                    echo '<div class="checkboxSlide">';
                    echo '<input type="checkbox" class="' . esc_attr($field['name']) . '" value="enabled" name="' . esc_attr($field['id']) . '" id="CheckboxSlide"' . checked($meta, true, false) . ' />';
                    echo '<br />' . esc_html($field['desc']);
                    echo '</div>';
                    echo '</div></div>';
                    break;
                
                case 'googlemap':
                    // Código específico para 'googlemap' (não incluído na solicitação)
                    break;
                
                    $value = $meta ? $meta : $field['default'];
                    $googlemap = explode(PHP_EOL, $value);
                    $googlemap_latitude = isset($googlemap[0]) ? $googlemap[0] : '';
                    $googlemap_longitude = isset($googlemap[1]) ? $googlemap[1] : '';
                    $googlemap_zoom = isset($googlemap[2]) ? $googlemap[2] : '';
                    
                    echo '<div class="boxes-googlemaps">';
                    echo '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_html(str_replace("_", " ", $title)) . '</label></div>';
                    echo '<div class="box-content"><p>';
                    echo 'Latitude';
                    echo '<br />';
                    echo '<input type="text" name="product-latitude" class="googlemap" id="product-latitude" value="' . esc_attr($googlemap_latitude) . '" size="30" style="width:97%" />' . '<br />';
                    echo '</div>';
                    echo '<div class="box-content"><p>';
                    echo 'Longitude';
                    echo '<br />';
                    echo '<input type="text" name="product-longitude" class="googlemap" id="product-longitude" value="' . esc_attr($googlemap_longitude) . '" size="30" style="width:97%" />' . '<br />';
                    echo '</div>';
                    echo '<div class="box-content"><p>';
                    echo 'Zoom';
                    echo '<br />';
                    echo '<input type="text" name="product-zoom" class="googlemap" id="product-zoom" value="' . esc_attr($googlemap_zoom) . '" size="30" style="width:97%" />' . '<br />';
                    echo '</div>';
                    
                // echo '</div>';
                echo '</div></div>';
                break;
        } // end Switch
        //   echo '</div></div>';
    }
} // end function listing_format_box
add_action('save_post', 'multidealer_listing_save_data');
function multidealer_listing_save_data($post_id)
{
    global $multidealer_Mapfield_name, $current_post_id,$multidealer_meta_box, $post, $$multidealer_a_features;
    $current_post_id = $post_id;
    if (!is_object($post))
        return;
    if (!isset($multidealer_meta_box[$post->post_type]['fields'])) {
        return;
    }
    //Verify nonce
    if (isset($_POST['listing_meta_box_nonce'])) {
        if (!wp_verify_nonce(sanitize_text_field($_POST['listing_meta_box_nonce']), basename(__file__))) {
            return $post_id;
        }
    }
    //Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    //Check permissions
    if (isset($_POST['post_type'])) {
        if ('page' == sanitize_text_field($_POST['post_type'])) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    } else
        return;
    foreach ($multidealer_meta_box[$post->post_type]['fields'] as $field) {
        if ($field['id'] == $multidealer_Mapfield_name) {
            if(isset($_POST['product-latitude']))
             $latitude = sanitize_text_field($_POST['product-latitude']);
            else
            $latitude = '';
            if(isset($_POST['product-longitude']))
              $longitude = sanitize_text_field($_POST['product-longitude']);
            else
             $longitude = '';
            if(isset($_POST['product-zoom']))
               $zoom = sanitize_text_field($_POST['product-zoom']);
            else
               $zoom = '';
            if(isset($_POST['product-address']))
              $address = sanitize_text_field($_POST['product-address']);
            else
               $address = '';
            $new = $latitude . PHP_EOL . $longitude . PHP_EOL . $zoom . PHP_EOL . $address;
            update_post_meta($post_id, $field['id'], trim($new));
        } // end googlemap
        else {
            if (isset($_POST[$field['id']])) {
                $new = sanitize_text_field($_POST[$field['id']]);
            } else {
                $new = '';
            }
           if($field['id'] == 'product-price' )
          { 
            if($new == '')
              $new = '0';  
            $r = update_post_meta($post_id, $field['id'], trim($new));
         }
         else
         {   
            $old = get_post_meta($post_id, $field['id'], true);
            if ($new && $new != $old) {
                $r = update_post_meta($post_id, $field['id'], trim($new));
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
        }
    } // end loop
} // end Function Save Data