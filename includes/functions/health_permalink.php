<?php
if (!defined('ABSPATH'))
exit; // Exit if accessed directly
global $wp_version;

if (version_compare($wp_version, '5.2') >= 0) {
    multidealer_health_permalink();
} else {
    return;
}

function multidealer_health_permalink()
{
    function multidealer_add_permalink_test($tests)
    {
        $tests['direct']['permalink'] = array(
            'label' => __('Wrong Permalink', 'multidealer'),
            'test' => 'multidealer_permalink_test',
        );
        return $tests;
    }
  
   $multidealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
	if (strpos($multidealerurl, '/options-permalink.php') === false) {
		$permalinkopt = get_option('permalink_structure');
		if ($permalinkopt != '/%postname%/')
				add_filter('site_status_tests', 'multidealer_add_permalink_test');
	}
  
    
    function multidealer_permalink_test()
    {


        $result = array(
            'badge' => array(
                'label' => __('Critical', 'multidealer'), // Performance
                'color' => 'red', // orange',
            ),
            'test2' => 'Bill_plugin',
            'status' => 'critical',
            'label' => __('Wrong Permalink Settings', 'multidealer'),
            'description' =>  sprintf(
                '<p>%s</p>',
                __('Please, fix it to avoid 404 error page.
                     To correct, just go to 
                     Dashboard => Settings => Permalinks => Post Name (check)
                     Then, click Save Changes.','multidealer')
            ),
        );
        return $result;
    }
}
