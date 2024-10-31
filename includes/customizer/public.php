<?php
/**
 * Front-facing functionality.
 * 2023-05-31
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
/**
 * Print inline style element.
 *
 */
function multidealer_enqueue_dynamic_styles() {
    // Generate the dynamic CSS code
	$dynamic_styles = multidealer_the_css();
		wp_register_style( 'multidealer-dynamic-styles', false ); 
		wp_enqueue_style( 'multidealer-dynamic-styles' ); 
		$r = wp_add_inline_style( 'multidealer-dynamic-styles', $dynamic_styles ); 
}
 add_action( 'wp_enqueue_scripts', 'multidealer_enqueue_dynamic_styles', 99999 );
function multidealer_enqueue_dynamic_script2() {
	$multidealer_template_button_color =	get_option( 'multidealer-template-button-color', 'white' );
	$multidealer_template_button_bkg_color =	get_option( 'multidealer-template-button-bkg-color', 'gray' );
	$multidealer_template_button_radius =	get_option( 'multidealer-template-button-radius', '0 px' );
	$set_border =  $multidealer_template_button_radius.'px';
	$set_bkg_color = $multidealer_template_button_bkg_color;
	$set_color = $multidealer_template_button_color;
	$multidealer_slider_color =	get_option( 'multidealer-search-slider-control-bkg-color', '0 px' );
	$multidealer_template_single_features_border_color = get_option( 'multidealer-template-single-features-border-color', 'gray' );
    $dynamic_script = "
        jQuery(document).ready(function($) {
			var count = $('[id^=\"multidealer_btn_view-\"]').length;
			for (let i = 1; i <= count; i++) {
				let elementId = '#multidealer_btn_view-' + i;
				//console.log(elementId);
				$(elementId).css('background', '$set_bkg_color');
				$(elementId).css('color', '$set_color');
				$(elementId).css('border-radius', '$set_border');
			}
			var setcolor = '1px solid $multidealer_template_single_features_border_color';
			$('.featuredCar').css('border', 'setcolor');
		});
    ";
    $handle = 'dynamic-script';
	wp_register_script( 'multidealer-dynamic-script', false ); 
	wp_enqueue_script( 'multidealer-dynamic-script' ); 
    wp_add_inline_script( 'multidealer-dynamic-script', $dynamic_script );
}
add_action( 'wp_enqueue_scripts', 'multidealer_enqueue_dynamic_script2','99999' );
/**
 * Echo the CSS.
 *
 */
function multidealer_the_css() { ?>
<style type='text/css'>
/* Car Template */
.multidealer-item-grid { 
   border : 1px solid gray;
}
.multidealer_gallery_2016 { 
   border : 1px solid gray;
}
.sideTitle, .multidealer_caption_img, .multidealer_caption_text, .multidealer_gallery_2016 { 
	border-radius : 6px 6px 0px 0px; 
}
.carTitle, .sideTitle, .multiTitle-widget { 
   background : gray;
   color: white; 
   height: 30px;
}
#multidealer_content { 
	background : lightgray;
}
/* 6-23 */
#container2  { 
  /* background : lightgray; */
}

.multiTitle17, .multiInforightText17  {
	color : gray;
}
.multidealer_description, #multidealer_content, .multiBasicRow, .multi-content-modal {
	color : gray;
}
[id^="multidealer_btn_view-"] {
	width : 120px;
}
.multidealer_container17 {
	border-bottom:  1px solid gray ;
}
/* Single Car Template */
#content2 {
	background : #F5F5F5;
}
.multiContent, #content2, .featuredList, .multicontentWrap {
	color : gray;
}
.featuredTitle {
	color : white;	
	background : gray;
	border-radius : graypx graypx 0px 0px ;
}
.featuredCar {
	/* color : gray; */
	border : 1px solid gray;
	border-radius : 0px 0px graypx graypx;

}
.featuredList {
	color : gray;
}
#multidealer_goback, #multidealer_cform  {
	color : white;	
	background : gray;
	border-radius : 10px;;
	width: 200px;;	
}
#multidealer-submitBtn, #multidealer-submitBtn-widget  {
	color : white;	
	background : gray;
	border-radius : 5px;;
	width : 100px;;
}
.multidealer-search-box {
	border : 0px solid gray;
	border-radius : 5px;;
	border-color : gray;
}
#multidealer-search-box {
	margin-bottom: 25px;;
}
.multidealer-search-label, .search-label-widget {
	color : gray;
}
.multidealer-select-box-meta, .multidealer-select-box-meta-widget  {
	color : gray;	
	background : white;
	border-radius : 5px;;
}
.multidealerlabelprice , #meta_price, .multidealerlabelprice2 , #meta_price2 {
  color : gray;
}
/* slider */
.ui-slider .ui-slider-range{
	/* margin-top: 20px; */
	background : gray; 
}
.ui-state-default, .ui-widget-content .ui-state-default{
	/* margin-top: 20px; */
	background : gray; /*!important; */ 
}
#slider-button-0, #slider-button-1, #slider-button-2, #slider-button-3  {
	background: gray;
	width: 1.0em;
	height: 1.0em;
	border-radius: 50%

}
.multidealer-price-slider, .multidealer-price-slider2 {
	background: white; 
	border-radius: 5px;;
	border: 1px solid gray;
}
.MultiDealer-search-box-widget {
	background: lightgray;	
	border: 1px solid gray;
}
</style>
<?php }