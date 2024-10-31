<?php
/**
 * @author Bill Minozzi
 * @copyright 2017-2023
 */
 if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

function multidealer_add_custom_js_to_header() {
      ?>
      <script type="text/javascript">
          function multidealer_goBack() {
              window.history.back(); 
          }
      </script>
      <?php
  }
  add_action('wp_head', 'multidealer_add_custom_js_to_header');   
    
$my_theme =  strtolower(wp_get_theme());
if ($my_theme == 'twenty fourteen')
{
?>
<style type="text/css">
<!--
	.site::before {
    width: 0px !important;
}
-->
</style>
<?php 
}
 get_header();
  ?>
	    <div id="container2"> 
        
        
         <?php 
        if(isset($_SERVER['HTTP_REFERER']))
         {?>
          <center>
          <button id="multidealer_goback" onclick="multidealer_goBack()">
          <?php 
          echo esc_attr__('Back', 'multidealer');?> 
          </button>
          <br /><br />
          </center>
        <?php } ?>       
        
        
        
        
        
        
        
            <div id="content2" role="main">
				<?php multidealer_multi_dealer_detail();
               $multidealer_enable_contact_form = trim(get_option('multidealer_enable_contact_form', 'yes'));
               if ($multidealer_enable_contact_form == 'yes')
               {               
                ?>
                 <br />
                 <center>
                 <button id="multidealer_cform">
                 <?php echo esc_attr__('Contact Us', 'multidealer'); ?>
                 </button>
                 </center>
                 <br />
			</div> 
            <?php
            } 
               if ($multidealer_enable_contact_form == 'yes')               
                  include_once (MULTIDEALERPATH . 'includes/contact-form/multi-contact-show-form.php');  
         ?>  
		</div>
<?php 
        $registered_sidebars = wp_get_sidebars_widgets();
        foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
        	unregister_sidebar( $sidebar_name );
        }
get_footer(); 
?>