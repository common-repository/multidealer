<?php

/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
if (is_admin()) {
    add_action('current_screen', 'multidealer_this_screen');
    function multidealer_this_screen()
    {
        require_once ABSPATH . 'wp-admin/includes/screen.php';
        $current_screen = get_current_screen();
        //echo $current_screen->id;
        // die();
        if ($current_screen->id === "edit-multidealerfields") {
            multidealer_contextual_help_fields($current_screen);
        } elseif ($current_screen->id === "products") {
            multidealer_contextual_help_products($current_screen);
        } elseif ($current_screen->id === "edit-makes") {
            multidealer_contextual_help_makes($current_screen);
        } elseif ($current_screen->id === "edit-locations") {
            multidealer_contextual_help_locations($current_screen);
        } elseif ($current_screen->id === "toplevel_page_multi_dealer_plugin" or $current_screen->id === "admin_page_md_settings") {
            multidealer_main_help($current_screen);
        } else {
            if (isset($_GET['page'])) {
                if (sanitize_text_field($_GET['page']) == 'multi_dealer_plugin') {
                    multidealer_main_help($current_screen);
                }
            }
        }
    }
}






/*
function multidealer_main_help($screen)
{
    $myhelp = '<br> The easiest way to manage, list and sell yours products online.';
    $myhelp .= '<br />';
    $myhelp .= 'Follow the 3 steps in this main screen after install the plugin. <br />';
    $myhelp .= '<br />';
    $myhelp .= 'You will find Context Help in many screens.';
    $myhelp .= '<br />';
    $myhelp .= 'You can find also our complete OnLine Guide  <a href="http://multidealerplugin.com/guide/" target="_self">here.</a>';
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => __('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));

    $myhelpdemo = '<br />';
    $myhelpdemo .= 'If you want to import demo data, download the demo data from this link:';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'http://multidealerplugin.com/demo-data/download-demo.php';
    $myhelpdemo .= '<br /><br />';
    $myhelpdemo .= 'After download:';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '1. Log in to that site as an administrator. ';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '2. Go to Tools: Import in the WordPress admin panel.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '3. Install the "WordPress" importer from the list.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '4. Activate & Run Importer.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '5. Upload the file downloaded using the form provided on that page.';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '6. You will first be asked to map the authors in this export file to users';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'on the site. For each author, you may choose to map to an';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= 'existing user on the site or to create a new user. ';
    $myhelpdemo .= '<br />';
    $myhelpdemo .= '7. WordPress will then import the demo data into you site.';
    $myhelpdemo .= '<br />';
    $screen->add_help_tab(array(
        'id' => 'import-demo',
        'title' => __('Import Demo Data', 'multidealer'),
        'content' => '<p>' . $myhelpdemo . '</p>',
    ));
    return;
}



function multidealer_contextual_help_fields($screen)
{
    $myhelp = 'In the FIELDS screen you can manage the main table fields.
    This fields will show up
    in your main dealer form management, search bar and search widget.
    <br />
    Each row represents one field.
    <br />
    For example, if you are a Car Dealer, maybe you want add this fields:
    <br />
    <ul>
    <li>Fuel Type</li>
    <li>Year</li>
    <li>HP</li>
    <li>And So On</li>
    </ul>
    Or, if you are, in Real Estate Business, maybe you want add this fields:
    <ul>
    <li>Bedroom</li>
    <li>Pool</li>
    <li>Garage</li>
    <li>And So On</li>
    </ul>
    <br />
    Technical WordPress guys call this of Metadata.
    <br />
    You don\'t need add this fields:
    <ul>
    <li>Product Name (title)</li>
    <li>Price</li>
    <li>Featured</li>
    <li>Year</li>
    </ul>
    Don\'t create 2 fields with the same name.
    <br />
    <br />
    ';
    $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>
    <li>Type of Field</li>
    <li>And So On</li>
    </ul>
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />
     ';
    $myhelpTypes = 'You have available this types of fields (Control Types):
    <br />
    <ul>
    <li>Text (Used by text and numbers). It is not possible include this type of field in Search Bars.</li>
    <li>CheckBox</li>
    <li>Drop Down (also called select box)</li>
    <li>Google Map (For example: usefull in Real Estate business)</li>
    <li>Range Select (you can define de value min, max and step)</li>
    <!-- <li>Range Slider (you can define de value min, max and step)</li>  -->
    </ul>
    <br />
    For more details about HTML input types, please, check this page:
<a href="https://www.w3schools.com/html/html_form_input_types.asp ">https://www.w3schools.com/html/html_form_input_types.asp
</a>
   <br />
';
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Fields.
    <br />
    At the Add Fields and Edit Fields forms, put the mouse over each row and the menu show up. Then, click over Edit or Trash.
    <br />
    To know more about Edit Fields, please, check the Add Fields Form Option at this help menu.
     ';
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => __('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-field-types',
        'title' => __('Field Types', 'multidealer'),
        'content' => '<p>' . $myhelpTypes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-add',
        'title' => __('Add Fields Form', 'multidealer'),
        'content' => '<p>' . $myhelpAdd . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-field-edit',
        'title' => __('Edit and Trash Fields', 'multidealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    return;
}
function multidealer_contextual_help_products($screen)
{
    $myhelp = 'In the PRODUCTS screen you can manage (include, edit or delete) items in your Products Table.
    This products will show up in your site front page.
    <br />
    We suggest you take some time to complete your Field table before this step.
    <br />
    Dashboard => MultiDealer => Fields Table.
    <br />
    You will find some fields automatically included by the system (Title, Price, Featured and Year).
    Just add your products in this table.
    <br />
    If you are a car dealer, for example, you can add:
    <ul>
    <li>Title: Ford</li>
    <li>Year: 2017</li>
    <li>Price: 15000</li>
    <li>and so on ...</li>
    </ul>
    ';
    $myhelpAdd = 'To add fields in the table, click the button Add New. This can open the empty window to include your information:
     <br />
    <ul>
    <li>Field Name</li>
    <li>Field Label</li>
    <li>Field Order</li>
    <li>Show in Search Bar (your frontpage)</li>
    <li>Show in Search Widget (your frontpage)</li>
    <li>Type of Field</li>
    <li>And So On</li>
    </ul>
    In that screen, move the mouse pointer over each field to get help about that field.
    <br />
    Just fill out and click OK button.
    <br />
     ';
    $myhelpMakes = 'Use the Makes control it is optional. To add new makes, go to:
    <br />
    Dashboard=> Multi Dealer => Makes
    <br />
    If you are, for example, a car dealer, maybe you want add:
    <ul>
    <li>Ford</li>
    <li>Chevrolet</li>
    <li>And So On...</li>
    </ul>
    <br />
    <br />
';
    $myhelpLocation = 'Use the Location control it is optional. Maybe you want use it if you have more than one location.
    To add new locations, go to:
    <br />
    Dashboard=> Multi Dealer => Locations
    <br />
    If you are, for example, in Florida, maybe you want add:
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li>
    </ul>
    <br />
   <br />
';
    $myhelpEdit = 'You can manage the table, i mean, Add, Edit and Trash Products.
    <br />
    Use the Add New Buttom or to Edit, put the mouse over each row and the menu will show up. Then, click over Edit or Trash.
    <br />
     ';
    $myhelpFeatured = 'You can add one main image to each product.
    In the Products Form, click the button Set Featured Image at bottom right corner.
    <br />
    Read below Images Gallery menu voice about how to create a Image\'s gallery with many images to show up at the top of your product\'s page.
    <br />
    <br />
     ';
    $myhelpGallery = 'You can add many Images or one gallery for each product. Just go to Product\'s Form and add the images (or the gallery) in the main description field (click the Add Media buttom).
    Use the default WordPress Gallery or our plugin will create automatically one nice slider gallery. To enable the plugin gallery, go to
    Dashboard => Multi Dealer => Settings
    and look for Replace the Wordpress Gallery with Flexslider Gallery?
    Then, check Yes and Save Changes.
    This images and gallery will be visible in single product page.
    <br />
    To get more info about galleries,
    <a href="https://en.support.wordpress.com/gallery/" target="_blank">visit WordPress Help site.</a>
    <br />';
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => __('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-makes',
        'title' => __('Makes', 'multidealer'),
        'content' => '<p>' . $myhelpMakes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-location',
        'title' => __('Location', 'multidealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-edit',
        'title' => __('Edit and Trash Products', 'multidealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-featured',
        'title' => __('Featured Images', 'multidealer'),
        'content' => '<p>' . $myhelpFeatured . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-gallery',
        'title' => __('Images Gallery', 'multidealer'),
        'content' => '<p>' . $myhelpGallery . '</p>',
    ));
    return;
}
function multidealer_contextual_help_makes($screen)
{
    $myhelpMakes = 'Use the Makes table it is optional.
    <br />
    If you are, for example, a car dealer, maybe you want add:
    <ul>
    <li>Ford</li>
    <li>Chevrolet</li>
    <li>And So On...</li>
    </ul>
    <br />
';
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => __('Overview', 'multidealer'),
        'content' => '<p>' . $myhelpMakes . '</p>',
    ));
    return;
}
function multidealer_contextual_help_locations($screen)
{
    $myhelpLocation = 'Use the Location table it is optional. Maybe you want use it if you have more than one location.
    <br />
    If you are, for example, in Florida, maybe you want add:
    <ul>
    <li>Fort Lauderdale</li>
    <li>Miami</li>
    <li>And So On...</li>
    </ul>
   <br />
';
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => __('Overview', 'multidealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    return;
}
*/
function multidealer_main_help($screen)
{
    $myhelp = esc_html__('The easiest way to manage, list and sell yours products online.', 'multidealer');
    $myhelp .= '<br>';
    $myhelp .= esc_html__('Follow the 3 steps in this main screen after install the plugin.', 'multidealer');
    $myhelp .= '<br>';
    $myhelp .= esc_html__('You will find Context Help in many screens.', 'multidealer');
    $myhelp .= '<br>';
    $myhelp .= sprintf(
        esc_html__('You can find also our complete OnLine Guide %shere%s.', 'multidealer'),
        '<a href="' . esc_url('http://multidealerplugin.com/guide/') . '" target="_blank">',
        '</a>'
    );

    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => esc_html__('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));

    $myhelpdemo = esc_html__('If you want to import demo data, download the demo data from this link:', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_url('http://multidealerplugin.com/demo-data/download-demo.php');
    $myhelpdemo .= '<br><br>';
    $myhelpdemo .= esc_html__('After download:', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('1. Log in to that site as an administrator.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('2. Go to Tools: Import in the WordPress admin panel.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('3. Install the "WordPress" importer from the list.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('4. Activate & Run Importer.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('5. Upload the file downloaded using the form provided on that page.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('6. You will first be asked to map the authors in this export file to users on the site. For each author, you may choose to map to an existing user on the site or to create a new user.', 'multidealer');
    $myhelpdemo .= '<br>';
    $myhelpdemo .= esc_html__('7. WordPress will then import the demo data into you site.', 'multidealer');

    $screen->add_help_tab(array(
        'id' => 'import-demo',
        'title' => esc_html__('Import Demo Data', 'multidealer'),
        'content' => '<p>' . $myhelpdemo . '</p>',
    ));

    return;
}

function multidealer_contextual_help_fields($screen)
{
    $myhelp = esc_html__('In the FIELDS screen you can manage the main table fields. These fields will show up in your main dealer form management, search bar and search widget.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('Each row represents one field.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('For example, if you are a Car Dealer, maybe you want to add these fields:', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= '<ul>';
    $myhelp .= '<li>' . esc_html__('Fuel Type', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Year', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('HP', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('And So On', 'multidealer') . '</li>';
    $myhelp .= '</ul>';
    $myhelp .= esc_html__('Or, if you are in Real Estate Business, maybe you want to add these fields:', 'multidealer');
    $myhelp .= '<ul>';
    $myhelp .= '<li>' . esc_html__('Bedroom', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Pool', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Garage', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('And So On', 'multidealer') . '</li>';
    $myhelp .= '</ul>';
    $myhelp .= '<br />';
    $myhelp .= esc_html__('Technical WordPress guys call this Metadata.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__("You don't need to add these fields:", 'multidealer');
    $myhelp .= '<ul>';
    $myhelp .= '<li>' . esc_html__('Product Name (title)', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Price', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Featured', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Year', 'multidealer') . '</li>';
    $myhelp .= '</ul>';
    $myhelp .= esc_html__("Don't create 2 fields with the same name.", 'multidealer');
    $myhelp .= '<br /><br />';

    $myhelpAdd = esc_html__('To add fields in the table, click the button Add New. This can open the empty window to include your information:', 'multidealer');
    $myhelpAdd .= '<br />';
    $myhelpAdd .= '<ul>';
    $myhelpAdd .= '<li>' . esc_html__('Field Name', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('Field Label', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('Field Order', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('Show in Search Bar (your frontpage)', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('Show in Search Widget (your frontpage)', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('Type of Field', 'multidealer') . '</li>';
    $myhelpAdd .= '<li>' . esc_html__('And So On', 'multidealer') . '</li>';
    $myhelpAdd .= '</ul>';
    $myhelpAdd .= esc_html__('In that screen, move the mouse pointer over each field to get help about that field.', 'multidealer');
    $myhelpAdd .= '<br />';
    $myhelpAdd .= esc_html__('Just fill out and click OK button.', 'multidealer');
    $myhelpAdd .= '<br />';

    $myhelpTypes = esc_html__('You have available these types of fields (Control Types):', 'multidealer');
    $myhelpTypes .= '<br />';
    $myhelpTypes .= '<ul>';
    $myhelpTypes .= '<li>' . esc_html__('Text (Used by text and numbers). It is not possible to include this type of field in Search Bars.', 'multidealer') . '</li>';
    $myhelpTypes .= '<li>' . esc_html__('CheckBox', 'multidealer') . '</li>';
    $myhelpTypes .= '<li>' . esc_html__('Drop Down (also called select box)', 'multidealer') . '</li>';
    $myhelpTypes .= '<li>' . esc_html__('Google Map (For example: useful in Real Estate business)', 'multidealer') . '</li>';
    $myhelpTypes .= '<li>' . esc_html__('Range Select (you can define the value min, max and step)', 'multidealer') . '</li>';
    $myhelpTypes .= '</ul>';
    $myhelpTypes .= '<br />';
    $myhelpTypes .= sprintf(
        esc_html__('For more details about HTML input types, please, check this page: %s', 'multidealer'),
        '<a href="' . esc_url('https://www.w3schools.com/html/html_form_input_types.asp') . '" target="_blank">https://www.w3schools.com/html/html_form_input_types.asp</a>'
    );
    $myhelpTypes .= '<br />';

    $myhelpEdit = esc_html__('You can manage the table, i.e., Add, Edit and Trash Fields.', 'multidealer');
    $myhelpEdit .= '<br />';
    $myhelpEdit .= esc_html__('At the Add Fields and Edit Fields forms, put the mouse over each row and the menu shows up. Then, click over Edit or Trash.', 'multidealer');
    $myhelpEdit .= '<br />';
    $myhelpEdit .= esc_html__('To know more about Edit Fields, please, check the Add Fields Form Option in this help menu.', 'multidealer');

    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => esc_html__('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-field-types',
        'title' => esc_html__('Field Types', 'multidealer'),
        'content' => '<p>' . $myhelpTypes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-add',
        'title' => esc_html__('Add Fields Form', 'multidealer'),
        'content' => '<p>' . $myhelpAdd . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-field-edit',
        'title' => esc_html__('Edit and Trash Fields', 'multidealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));

    return;
}

function multidealer_contextual_help_products($screen)
{
    $myhelp = esc_html__('In the PRODUCTS screen you can manage (include, edit or delete) items in your Products Table. These products will show up on your site front page.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('We suggest you take some time to complete your Field table before this step.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('Dashboard => MultiDealer => Fields Table.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('You will find some fields automatically included by the system (Title, Price, Featured and Year). Just add your products in this table.', 'multidealer');
    $myhelp .= '<br />';
    $myhelp .= esc_html__('If you are a car dealer, for example, you can add:', 'multidealer');
    $myhelp .= '<ul>';
    $myhelp .= '<li>' . esc_html__('Title: Ford', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Year: 2017', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('Price: 15000', 'multidealer') . '</li>';
    $myhelp .= '<li>' . esc_html__('and so on ...', 'multidealer') . '</li>';
    $myhelp .= '</ul>';

    $myhelpMakes = esc_html__('Use the Makes control it is optional. To add new makes, go to:', 'multidealer');
    $myhelpMakes .= '<br />';
    $myhelpMakes .= esc_html__('Dashboard=> Multi Dealer => Makes', 'multidealer');
    $myhelpMakes .= '<br />';
    $myhelpMakes .= esc_html__('If you are, for example, a car dealer, maybe you want to add:', 'multidealer');
    $myhelpMakes .= '<ul>';
    $myhelpMakes .= '<li>' . esc_html__('Ford', 'multidealer') . '</li>';
    $myhelpMakes .= '<li>' . esc_html__('Chevrolet', 'multidealer') . '</li>';
    $myhelpMakes .= '<li>' . esc_html__('And So On...', 'multidealer') . '</li>';
    $myhelpMakes .= '</ul>';
    $myhelpMakes .= '<br /><br />';

    $myhelpLocation = esc_html__('Use the Location control it is optional. Maybe you want to use it if you have more than one location. To add new locations, go to:', 'multidealer');
    $myhelpLocation .= '<br />';
    $myhelpLocation .= esc_html__('Dashboard=> Multi Dealer => Locations', 'multidealer');
    $myhelpLocation .= '<br />';
    $myhelpLocation .= esc_html__('If you are, for example, in Florida, maybe you want to add:', 'multidealer');
    $myhelpLocation .= '<ul>';
    $myhelpLocation .= '<li>' . esc_html__('Fort Lauderdale', 'multidealer') . '</li>';
    $myhelpLocation .= '<li>' . esc_html__('Miami', 'multidealer') . '</li>';
    $myhelpLocation .= '<li>' . esc_html__('And So On...', 'multidealer') . '</li>';
    $myhelpLocation .= '</ul>';
    $myhelpLocation .= '<br /><br />';

    $myhelpEdit = esc_html__('You can manage the table, i.e., Add, Edit and Trash Products.', 'multidealer');
    $myhelpEdit .= '<br />';
    $myhelpEdit .= esc_html__('Use the Add New Button or to Edit, put the mouse over each row and the menu will show up. Then, click over Edit or Trash.', 'multidealer');
    $myhelpEdit .= '<br />';

    $myhelpFeatured = esc_html__('You can add one main image to each product. In the Products Form, click the button Set Featured Image at bottom right corner.', 'multidealer');
    $myhelpFeatured .= '<br />';
    $myhelpFeatured .= esc_html__("Read below Images Gallery menu voice about how to create an Image's gallery with many images to show up at the top of your product's page.", 'multidealer');
    $myhelpFeatured .= '<br /><br />';

    $myhelpGallery = esc_html__("You can add many Images or one gallery for each product. Just go to Product's Form and add the images (or the gallery) in the main description field (click the Add Media button).", 'multidealer');
    $myhelpGallery .= esc_html__('Use the default WordPress Gallery or our plugin will create automatically one nice slider gallery. To enable the plugin gallery, go to Dashboard => Multi Dealer => Settings and look for Replace the WordPress Gallery with Flexslider Gallery? Then, check Yes and Save Changes. These images and gallery will be visible in single product page.', 'multidealer');
    $myhelpGallery .= '<br />';
    $myhelpGallery .= sprintf(
        esc_html__('To get more info about galleries, %svisit WordPress Help site.%s', 'multidealer'),
        '<a href="' . esc_url('https://en.support.wordpress.com/gallery/') . '" target="_blank">',
        '</a>'
    );
    $myhelpGallery .= '<br />';

    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => esc_html__('Overview', 'multidealer'),
        'content' => '<p>' . $myhelp . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-makes',
        'title' => esc_html__('Makes', 'multidealer'),
        'content' => '<p>' . $myhelpMakes . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-location',
        'title' => esc_html__('Location', 'multidealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-edit',
        'title' => esc_html__('Edit and Trash Products', 'multidealer'),
        'content' => '<p>' . $myhelpEdit . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-featured',
        'title' => esc_html__('Featured Images', 'multidealer'),
        'content' => '<p>' . $myhelpFeatured . '</p>',
    ));
    $screen->add_help_tab(array(
        'id' => 'MultiDealer-products-gallery',
        'title' => esc_html__('Images Gallery', 'multidealer'),
        'content' => '<p>' . $myhelpGallery . '</p>',
    ));

    return;
}

function multidealer_contextual_help_makes($screen)
{
    $myhelpMakes = esc_html__('Use the Makes table it is optional.', 'multidealer');
    $myhelpMakes .= '<br />';
    $myhelpMakes .= esc_html__('If you are, for example, a car dealer, maybe you want to add:', 'multidealer');
    $myhelpMakes .= '<ul>';
    $myhelpMakes .= '<li>' . esc_html__('Ford', 'multidealer') . '</li>';
    $myhelpMakes .= '<li>' . esc_html__('Chevrolet', 'multidealer') . '</li>';
    $myhelpMakes .= '<li>' . esc_html__('And So On...', 'multidealer') . '</li>';
    $myhelpMakes .= '</ul>';
    $myhelpMakes .= '<br />';

    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => esc_html__('Overview', 'multidealer'),
        'content' => '<p>' . $myhelpMakes . '</p>',
    ));
    return;
}

function multidealer_contextual_help_locations($screen)
{
    $myhelpLocation = esc_html__('Use the Location table it is optional. Maybe you want to use it if you have more than one location.', 'multidealer');
    $myhelpLocation .= '<br />';
    $myhelpLocation .= esc_html__('If you are, for example, in Florida, maybe you want to add:', 'multidealer');
    $myhelpLocation .= '<ul>';
    $myhelpLocation .= '<li>' . esc_html__('Fort Lauderdale', 'multidealer') . '</li>';
    $myhelpLocation .= '<li>' . esc_html__('Miami', 'multidealer') . '</li>';
    $myhelpLocation .= '<li>' . esc_html__('And So On...', 'multidealer') . '</li>';
    $myhelpLocation .= '</ul>';
    $myhelpLocation .= '<br />';

    $screen->add_help_tab(array(
        'id' => 'MultiDealer-overview-tab',
        'title' => esc_html__('Overview', 'multidealer'),
        'content' => '<p>' . $myhelpLocation . '</p>',
    ));
    return;
}



/////////// Pointers ////////////////
add_action('admin_enqueue_scripts', 'multidealer_adm_enqueue_scripts2');
function multidealer_adm_enqueue_scripts2()
{
    global $multidealer_current_screen;
    // wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script('wp-pointer');
    require_once ABSPATH . 'wp-admin/includes/screen.php';
    $myscreen = get_current_screen();
    $multidealer_current_screen = $myscreen->id;
    if ($multidealer_current_screen == 'products' or $multidealer_current_screen == 'toplevel_page_multi_dealer_plugin' or $multidealer_current_screen == 'edit-multidealerfields') {
    } else {
        return;
    }

    $dismissed = explode(',', (string) get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
    if (in_array($multidealer_current_screen, $dismissed)) {
        return;
    }

    add_action('admin_print_footer_scripts', 'multidealer_admin_print_footer_scripts');
}
function multidealer_admin_print_footer_scripts()
{
    global $multidealer_current_screen;
    $pointer_content = esc_attr__('Help Available for this Window!', 'multidealer');
    $pointer_content2 = esc_attr__('Just Click Help Button to get content help for this window.', 'multidealer');
    //
    //
    //
?>
    <script type="text/javascript">
        //<![CDATA[
        // setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
        jQuery(document).ready(function($) {
            $('#contextual-help-link').pointer({
                content: '<?php echo '<h3>' . esc_attr($pointer_content) . '</h3>' . '<p>' . esc_attr($pointer_content2) . '</p>'; ?>',

                position: {
                    edge: 'top',
                    align: 'right'
                },
                close: function() {
                    // Once the close button is hit
                    $.post(ajaxurl, {
                        pointer: '<?php echo esc_html($multidealer_current_screen); ?>',
                        action: 'dismiss-wp-pointer'
                    });
                }
            }).pointer('open');
            /* $('.wp-pointer-undefined .wp-pointer-arrow').css("right", "50px"); */
        });
        //]]>
    </script>
<?php } ?>