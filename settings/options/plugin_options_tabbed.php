<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
namespace multidealer\WP\Settings;
$mypage = new Page('md_settings', array('type' => 'submenu2', 'parent_slug' =>'multi_dealer_plugin'));
$msg = 'This is a scction 1 ... ';
$settings = array();
$fields = array();

$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'MultiDealercurrency',
	'label' => __('Currency', 'multidealer'),
	'select_options' => array(
		array('value' => 'USD', 'label' => 'US Dollars (&#36;)'),
		array('value' => 'AED', 'label' => 'United Arab Emirates Dirham (&#1583;.&#1573;'),
		array('value' => 'AOA', 'label' => 'Angolan Kwanza'),
		array('value' => 'AFN', 'label' => 'Afghan Afghani (&#1547;)'),
		array('value' => 'ARS', 'label' => 'Argentine Pesos (&#36;)'),
		array('value' => 'AUD', 'label' => 'Australian Dollars (&#36;)'),
		array('value' => 'BRL', 'label' => 'Brazilian Real (R&#36;)'),
		array('value' => 'BGN', 'label' => 'Bulgarian Lev'),
		array('value' => 'CAD', 'label' => 'Canadian Dollars (&#36;)'),
		array('value' => 'CNY', 'label' => 'Chinese Yuan (&yen;)'),
		array('value' => 'HRK', 'label' => 'Croatian Kuna'),
		array('value' => 'CZK', 'label' => 'Czech Koruna'),
		array('value' => 'DKK', 'label' => 'Danish Krone'),
		array('value' => 'EUR', 'label' => 'Euros (&euro;)'),
		array('value' => 'HKD', 'label' => 'Hong Kong Dollar (&#36;)'),
		array('value' => 'HUF', 'label' => 'Hungarian Forint'),
		array('value' => 'INR', 'label' => 'Indian Rupee (&#8377;)'),
		array('value' => 'RIAL', 'label' => 'Iranian Rial (&#65020;)'),
		array('value' => 'ILS', 'label' => 'Israeli Shekel (&#8362;)'),
		array('value' => 'JPY', 'label' => 'Japanese Yen (&yen;)'),
		array('value' => 'KRW', 'label' => 'South Korean Won (₩)'),
		array('value' => 'MYR', 'label' => 'Malaysian Ringgits'),
		array('value' => 'MXN', 'label' => 'Mexican Peso (&#36;)'),
		array('value' => 'NZD', 'label' => 'New Zealand Dollar (&#36;)'),
		array('value' => 'NOK', 'label' => 'Norwegian Krone'),
		array('value' => 'PKR', 'label' => 'Pakistani Rupee (₨)'),
		array('value' => 'PHP', 'label' => 'Philippine Pesos'),
		array('value' => 'PLN', 'label' => 'Polish Zloty'),
		array('value' => 'GBP', 'label' => 'Pound Sterling (&pound;)'),
		array('value' => 'RON', 'label' => 'Romanian Leu'),
		array('value' => 'RUB', 'label' => 'Russian Rubles'),
		array('value' => 'SAR', 'label' => 'Saudi Riyal (&#65020;)'),
		array('value' => 'CHF', 'label' => 'Swiss Franc'),
		array('value' => 'SEK', 'label' => 'Swedish Krona'),
		array('value' => 'SGD', 'label' => 'Singapore Dollar (&#36;)'),
		array('value' => 'THB', 'label' => 'Thai Baht (&#3647;)'),
		array('value' => 'TRY', 'label' => 'Turkish Lira (&#8378;)'),
		array('value' => 'TWD', 'label' => 'Taiwan New Dollars'),
		array('value' => 'VND', 'label' => 'Vietnamese Dong (&#8363;)'),
		array('value' =>' YEN', 'label' => 'Yen (&yen;)'),
		array('value' => 'ZAR', 'label' => 'South African Rand'),
		array('value' => 'Universal', 'label' => 'Universal')
	)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'multidealer_measure',
	'label' => __('Miles - Km','multidealer'),
	'select_options' => array(
		array('value'=>'Miles', 'label' => __('Miles', 'multidealer')),
		array('value'=>'Kms', 'label' => __('Kms', 'multidealer')),
		array('value'=>'Hours', 'label' => __('Hours', 'multidealer'))
		)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'multidealer_liter',
	'label' => __('Liters - Gallons','multidealer'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'multidealer')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'multidealer')),
		)			
	);
	$fields[] =	array(
		'type' 	=> 'select',
		'name' => 'multidealer_quantity',
		'label' => __('How many products would you like to display per page?', 'multidealer'),
		'select_options' => array (
				array('value'=>'3', 'label' => '3'),
				array('value'=>'6', 'label' => '6'),
				array('value'=>'9', 'label' => '9'),
				array('value'=>'12', 'label' => '12'),
				array('value'=>'15', 'label' => '15'),
				array('value'=>'18', 'label' => '18'),
		 )
); 
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Remove Sidebar from Search Result Page','multidealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'multidealer_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery','multidealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'multidealer_enable_contact_form',
	'label' => __('Enable Contact Form in Single Product Page?','multidealer'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 
$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'multidealer_recipientEmail',
	'label' => __('Fill out your contact email to receive email from your Contact Form at bottom of the individual Product page.' ,'multidealer')
    ); 
   $fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'multidealer_googlemapsapi',
	'label' => __('Optional. Fill out your Google API to use with yours maps (google maps)' ,'multidealer')
    );   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'multidealer_widget_show_orderby',
	'label' => __('Show the Order By Control in the Search Bar','multidealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 


	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'multidealer_template_gallery',
		'label' => __('In Show Room Page, use Gallery, List View or Grid Template','multidealer').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Gallery'),
			array('value'=>'list', 'label' => 'List View'),
			array('value' => 'grid', 'label' => 'Grid (only Premium)'),
			)			
		);  
	
		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'multidealer_image_size',
			'label' => __('In Show Room Page, Template List View or Grid, Choose the thumbnail image size (width) - Only Premium', 'multidealer') . ':',
			'radio_options' => array(
				array('value' => 'populate_roles_300(  )', 'label' =>'300px'),
				array('value' => '350', 'label' =>'350px'),
				array('value' => '400', 'label' =>'400px'),
			)
		);
		
		
		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'multidealer_template_single',
			'label' => __('In Single Product Page, use Template', 'multidealer') . ':',
			'radio_options' => array(
				array('value' => '1', 'label' =>'Model 1'),
				array('value' => '2', 'label' => 'Model 2 (with sidebar) - Only Premium'),
			)
		);

		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'multidealer_auto_updates',
			'label' =>esc_attr__("Enable Auto Update Plugin? (default Yes)", "multidealer"),
			'radio_options' => array(
				array('value' => 'Yes', 'label' =>esc_attr__('Yes, enable Multi Dealer Auto Update', "cardealer")),
				array('value' => 'No', 'label' =>esc_attr__('No (unsafe)', "multidealer")),
			)
		); 

$settings['Multidealer Settings']['Settings']['fields'] = $fields;
    $settings['Multidealer Design']['Multidealer Design'] = array('info' => __('Choose colours and so on',
            'multidealer'));
    $fields = array();
    $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'multi_search_bt_bk_color',
    	'label' => __('Search Button Background Color', 'multidealer')
    	);
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'multi_search_bt_color',
    	'label' => __('Search Button Color', 'multidealer')
    	);  
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_background_color',
        'label' => __('Background Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_foreground_color',
        'label' => __('Foreground Text Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_foreground_label_color',
        'label' => __('Label Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_select_border_color',
        'label' => __('Select Border Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_page_background_color',
        'label' => __('product Background Page Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'product_multis_box_border_color',
        'label' => __('product Box Border Color', 'multidealer'));
    $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'multi_title_color',
    	'label' =>  __('Select Title Color', 'multidealer')
    	);    
    $fields[] = array(
        'type' => 'color',
        'name' => 'multi_individual_product_page_background',
        'label' => __('Single product Page Background Color', 'multidealer'));
    $fields[] = array(
        'type' => 'color',
        'name' => 'product_individual_page_foreground_color',
        'label' => __('Single product Page Foreground Text Color', 'multidealer'));
    $fields[] = array(
        'type' => 'textarea',
        'name' => 'multi_my_css',
        'label' => __('Customized CSS', 'multidealer'));
$settings['Multidealer Design']['Multidealer Design']['fields'] = $fields;

// Orderby
$fields = array();
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'multidealer_show_orderby',
	'label' => __('Show the Order By Control','multidealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
	
    $fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'multidealer_show_make',
		'label' => __('Show the Make Control','multidealer').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Yes'),
			array('value'=>'no', 'label' => 'No'),
			)			
		);

$settings['Search']['Search']['fields'] = $fields;
$settings['Widget']['Widget'] = array('info' => __('Customize your Search Widget Options. Choose the fields to show on the Search Widget.','multidealer'));
$fields = array(); 

 $fields[] = array(
  	'type' 	=> 'radio',
	'name' 	=> 'multidealer_widget_show_orderby',
	'label' => __('Show the Order By Control','multidealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);  

	$fields[] = array(
		'type' 	=> 'radio',
	  'name' 	=> 'multidealer_widget_show_make',
	  'label' => __('Show the Make Control','multidealer').'?',
	  'radio_options' => array(
		  array('value'=>'yes', 'label' => 'Yes'),
		  array('value'=>'no', 'label' => 'No'),
		  )			
	  );  





$settings['Widget']['Widget']['fields'] = $fields;








// end Orderby

new OptionPageBuilderTabbed($mypage, $settings);
