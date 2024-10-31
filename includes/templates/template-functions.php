<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
 if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
 function multidealer_maps()
 {
       $googleapi = get_option('multidealer_googlemapsapi', 6); 
    if( empty($googleapi))
       return;
    $post_product_id = get_the_ID(); 
    $googlemapname = multidealer_findglooglemap();
    if( empty($googlemapname))
      return;
    $value = get_post_meta($post_product_id, $googlemapname, true);
    if(empty($value))
      return;
      
   if( gettype($value) != 'string')
     return;      
      
    echo '<div id="multidealer_googleMap"></div>';
    $googlemap = explode(PHP_EOL, $value);
                if (isset($googlemap[0]))
                    $googlemap_latitude = $googlemap[0];
                else
                    $googlemap_latitude = '';
                if (isset($googlemap[1]))
                    $googlemap_longitude = $googlemap[1];
                else
                    $googlemap_longitude = '';
                if (isset($googlemap[2]))
                    $googlemap_zoom = $googlemap[2];
                else
                    $googlemap_zoom = '';
                /*    
                if (isset($googlemap[3]))
                    $googlemap_address = $googlemap[3];
                else
                    $googlemap_address = '';
                 */
   if( ! empty($googlemap_latitude ) and ! empty($googlemap_longitude) and !empty($googlemap_zoom) )
   {
?>
    <script>
      function multidealer_initMap() {
        var guluru = {lat: <?php echo esc_attr($googlemap_latitude);?>, lng: <?php echo esc_attr($googlemap_longitude);?>};
        var map = new google.maps.Map(document.getElementById('multidealer_googleMap'), {
          zoom: <?php echo esc_attr($googlemap_zoom);?>,
          center: guluru
        });
        var marker = new google.maps.Marker({
          position: guluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($googleapi);?>&callback=multidealer_initMap" type="text/javascript">
    </script>
<?php
   }   
   return true;
 }
 function multidealer_content_detail (){
    $post_product_id = get_the_ID();
    ?>
    <div class="multi-content">
        <div id="sliderWrapper">
                 <?php 
                 // multidealer_maps();
                 $terms3 = get_the_terms( $post_product_id, 'locations');
                 // die();

                 if(is_array($terms3))
                 {

                    if ($terms3 && !is_wp_error($terms3)) {
                        $term3 = $terms3[0]; 



                        if(is_object($term3))
                            {
                                echo '<div class="featuredTitle">'; 
                                echo esc_attr__('Location', 'multidealer').': ';  
                                echo esc_attr($term3->name); 
                                echo '</div>';
                            }
                    }

                        
                  } 
                    
                 multidealer_maps();   
                 $terms = get_the_terms( $post_product_id, 'makes');
                 if(is_array($terms))
                    {
                        $term = $terms[0]; 
                         echo '<div class="featuredTitle">'; 
                         echo esc_attr__('Make', 'multidealer').': ';  
                         echo esc_attr($term->name); 
                         $model = trim(get_post_meta(get_the_ID(), 'multi-model', 'true'));
                         if(! empty($model)) 
                         {
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo esc_attr__('Model', 'multidealer').': ';  
                           echo esc_attr($model);
                         } 
                         echo '</div>';
                 }      
                 else
                 { ?>
             <div class="featuredTitle"> 
             <?php echo esc_attr__('Options', 'multidealer');
             ?> 
             </div>
             <?php } ?>
               <div class="featuredCar">
             <?php
        $afieldsId = multidealer_get_fields('all');
        $totfields = count($afieldsId);
        $ametadataoptions = array();
  for ($i = 0; $i < $totfields; $i++) {
            $post_id = $afieldsId[$i];
    $ametadata = multidealer_get_meta($post_id);        
    if (!empty($ametadata[0]))
        $label = $ametadata[0];
    else
        $label = $ametadata[12];
    $field_id = 'product-'.$ametadata[12];
    $value = get_post_meta($post_product_id, $field_id, true);
             $typefield = $ametadata[1];
             if ($value != '' and $typefield != 'googlemap' ) { 
                 if ($typefield == 'checkbox')
                   if($value == 'enabled')
                     $value = esc_attr__('Yes', 'multidealer');
                   else
                     $value = esc_attr__('No', 'multidealer');
             ?>
             <div class="featuredList">             
             <span class="multiBold"> <?php echo esc_attr($label);?>: </span><?php echo '<b>' . esc_attr($value).'</b>';?> 
             </div><!-- End of featured list --><?php }
             }
             ?>
             </div><!-- End of featured multi -->
      </div> <!-- end of Slider Content --> 
      </div> <!-- end of Slider Wrapper -->  
      <?php }
 function multidealer_content_info () { ?>
 <div class="contentInfo">
         <div class="multiPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'product-price', true);
           if ($price <> '' and $price != '0')
             { 
                $price =   number_format_i18n($price,0);
                $price = multidealer_currency() . $price;
             }
             else
                $price =  esc_attr__('Call for Price', 'multidealer'); 
            echo esc_attr($price);
    		?> 
         </div>
         <div class="multiContent">
         	<?php the_content(); ?>
         </div> 
            <?php 
            $year = get_post_meta(get_the_ID(), 'product-year', 'true'); 
            if($year)
            { ?>
            <div class="multiDetail">
                 <?php echo esc_attr__('Year', 'multidealer').': ';
                   echo esc_attr($year); 
                ?>
                <!--
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr(get_option('multidealer_measure'), 'multidealer')?>: </span> <?php echo esc_attr(get_post_meta(get_the_ID()), 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr__('Cond', 'multidealer');?>: </span> <?php echo esc_attr(get_post_meta(get_the_ID()), 'multi-con', 'true'); ?></div>
                <div class="multiBasicRow"><span class="singleInfo"><?php echo esc_attr__('HP', 'multidealer');?>:&nbsp; </span> <?php echo esc_attr(get_post_meta(get_the_ID()), 'multi-hp', 'true'); ?></div>
                -->
            </div>
            <?php } ?> 
 </div>	 
 <?php }
function multidealer_multi_dealer_detail() {
  echo '<div class="multi-content">';
	while ( have_posts() ) : the_post(); 
       multidealer_title_detail();
       multidealer_content_info (); 
      ?> 
     <div class="multicontentWrap">
	 <?php multidealer_content_detail (); ?>
     </div><?php
     break;
	 endwhile; // end of the loop.
     echo '</div>';
}
function multidealer_title_detail(){
global $multidealer_the_title;
   $multidealer_the_title = get_the_title(); ?>
    <div class="multi-detail-title">  <?php the_title(); ?> </div>
<?php }
require_once(MULTIDEALERPATH . "assets/php/multidealer_mr_image_resize.php");
function multidealer_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
    	  	$url = MULTIDEALERIMAGES.'image-no-available.jpg';
		}
       return multidealer_mr_image_resize($url, $width, $height, true, $align, false);
}
