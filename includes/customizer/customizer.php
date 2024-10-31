<?php
/**
 * Customizer functionality.
 *
 */
if (!defined("ABSPATH")) {
    die();
}
//
function multidealer_plugin_customize_register($wp_customize)
{
    $section_id = "bill_section";
    /*            ///  PANEL //////     */
    $r = $wp_customize->add_panel("bill_designer", [
        "title" => esc_html__("multidealer Custom Design", "login-designer"),
        "capability" => "edit_theme_options",
        "description" => esc_html__(
            'Click the Templates icon at the top left of the preview window to change your template. To customize further, simply click on any element, or it\'s corresponding shortcut icon, to edit it\'s styling. ',
            "login-designer"
        ),
        "priority" => 150,
    ]);
    /*            ///  END PANEL //////             */
    /*            ///   SECTION HELP  //////     */
    $section_id = "multidealer_help_section";
    $wp_customize->add_section($section_id, [
        "title" => __("Help", "multidealer"),
        "capability" => "manage_options",
        "panel" => "bill_designer",
    ]);
    function multidealer_custom_customize_render_section($section)
    {
        echo '<div style="text-align: center;">';
        submit_button("Help", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://multidealerplugin.com/help/#99", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);
        echo "&nbsp;&nbsp;&nbsp;";
        submit_button("Demo Video", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://cardealerplugin.com/movies/customizer.mp4", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);
        echo "</div>";
    }
    add_action(
        "customize_render_section_multidealer_help_section",
        "multidealer_custom_customize_render_section"
    );
    // Section Template //
    $section_id = "template name";
    $wp_customize->add_section($section_id, [
        "title" => __("Templates", "multidealer") . " (2 FREE)",
        "capability" => "manage_options",
        "description" => __(
            "Choose the Multi Dealer Template to Use.",
            "multidealer"
        ),
        "panel" => "bill_designer",
    ]);
    /*            ///   END SECTION  //////     */
    // Single Multi Section Template //
        $section_id = "single_multi_template_name";
        $wp_customize->add_section($section_id, [
            "title" => __("Single Multi Templates", "multidealer") . " (1 FREE)",
            "capability" => "manage_options",
            "description" => __(
                "Choose the Single Multi Template to Use.",
                "multidealer"
            ),
            "panel" => "bill_designer",
        ]);
    /*            ///   END Single Multi SECTION  //////     */
    $section_id = "search Box";
    $wp_customize->add_section($section_id, [
        "title" => __("Search Box LayOut", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Design the Search Box", "multidealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("fields", [
        "title" => __("Search Box Fields", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Manage the Design fields", "multidealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("slider", [
        "title" => __("Search Box Slider", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the price Slider.", "multidealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("button", [
        "title" => __("Search Box Button", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Search Box Button.", "multidealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("template", [
        "title" => __("Multi Template and Widgets", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Multi Template and Widgets.",
            "multidealer"
        ),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("template-single", [
        "title" => __("Single Multi Template", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Single Multi Template.", "multidealer"),
        "panel" => "bill_designer",
    ]);
    $wp_customize->add_section("back-contact-us", [
        "title" => __("Buttons Back and Contact Us", "multidealer") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Buttons Back and Contact Us.",
            "multidealer"
        ),
        "panel" => "bill_designer",
    ]);
    /* --------------------- END SECTIONS ---------------------- */
    /*    -------------  Fields --------------- */
    $wp_customize->add_setting("meu_plugin_help_link_setting", [
        "type" => "option",
    ]);
    $wp_customize->add_control("meu_plugin_help_link", [
        "label" => "Link de Ajuda aberto em nova janela.",
        "section" => "multidealer_help_section",
        "settings" => "meu_plugin_help_link_setting",
        "type" => "url",
    ]);
    // exemplo de radio com PRO
    // Add a new setting
    $wp_customize->add_setting("myplugin_setting", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
/*
    $wp_customize->add_control("k_layout_type", [
        "section" => "fields",
        "settings" => "myplugin_setting",
        "type" => "radio",
        "label for" => __("Website Layout", "kardealer") . " -only pro-",
        "description" => "",
        "choices" => [
            "3" => "Boxed Width 1200px",
            "1" => "Boxed Width 1000px",
            "2" => "Wide",
        ],
    ]);
         ///   ADD PRO TO CONTROL   ///  */
    /*
    function multidealer_customize_render_control($control)
    {
        ?>
			  <div>This is my custom content for the "My Plugin Setting" control.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php
    }
    add_action(
        "customize_render_control_k_layout_type",
        "multidealer_customize_render_control"
    );
    */
    /*  		///   END ADD PRO TO CONTROL   ///  */
    $wp_customize->add_setting("multidealer-plugin-search-fields-label-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-fields-label-color", [
        "label" => __("Search Fields Label Color", "multidealer"),
        "section" => "fields",
        "settings" => "multidealer-plugin-search-fields-label-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-fields-control-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-fields-control-color", [
        "label" => __("Search Fields Controls Color", "multidealer"),
        "section" => "fields",
        "settings" => "multidealer-plugin-search-fields-control-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-fields-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-fields-control-bkg-color", [
        "label" => __("Search Fields Controls Background Color", "multidealer"),
        "section" => "fields",
        "settings" => "multidealer-plugin-search-fields-control-bkg-color",
        "type" => "color",
    ]);
    //View Fields round
    $wp_customize->add_setting("multidealer-plugin-search-fields-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-fields-radius", [
        "type" => "range",
        "section" => "fields",
        "settings" => "multidealer-plugin-search-fields-radius",
        "label" => __("Search Fields Controls Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    // Flexslider
    $wp_customize->add_setting("multidealer-plugin-search-slider-label-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-label-color", [
        "label" => __("Search Slider Label Color", "multidealer"),
        "section" => "slider",
        "settings" => "multidealer-plugin-search-slider-label-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-slider-control-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-control-color", [
        "label" => __("Search Slider Color", "multidealer"),
        "section" => "slider",
        "settings" => "multidealer-plugin-search-slider-control-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-slider-handle-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-handle-color", [
        "label" => __("Search Slider Handle Color", "multidealer"),
        "section" => "slider",
        "settings" => "multidealer-plugin-search-slider-handle-color",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-slider-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-control-bkg-color", [
        "label" => __("Search Slider Background Color", "multidealer"),
        "section" => "slider",
        "settings" => "multidealer-plugin-search-slider-control-bkg-color",
        "type" => "color",
    ]);
    //View Fields round
    $wp_customize->add_setting("multidealer-plugin-search-slider-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-radius", [
        "type" => "range",
        "section" => "slider",
        "label" => __("Search Slider Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    
    // Slider Border Color
    $wp_customize->add_setting("multidealer-plugin-search-slider-border-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-slider-border-color", [
        "label" => __("Search Slider Border Color", "multidealer"),
        "section" => "slider",
        "settings" => "multidealer-plugin-search-slider-border-color",
        "type" => "color",
    ]);
    /*    -------------  END BUTTONS -------- */
    /*    -------------  BUTTON -------- */
    //Button Background
    //Button Color
    $wp_customize->add_setting("multidealer-plugin-search-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-button-color", [
        "label" => __("Search Box Button Text Color", "multidealer"),
        "section" => "button",
        "settings" => "multidealer-plugin-search-button-color",
        "type" => "color",
    ]);
    //Button Background
    $wp_customize->add_setting("multidealer-plugin-search-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-button-bkg-color", [
        "label" => __("Search Box Button Background Color", "multidealer"),
        "section" => "button",
        "settings" => "multidealer-plugin-search-button-bkg-color",
        "type" => "color",
    ]);
    //Search  Button width
    $wp_customize->add_setting("multidealer-plugin-search-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-button-width", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Width","multidealer"),
        "description" => __("Button width: from 100 to 300.","multidealer"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    $wp_customize->add_setting("multidealer-plugin-search-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-button-radius", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    /*    -------------  END BUTTON -------- */
    /*    -------------  SLIDER -------- */
    /*    -------------  END SLIDER -------- */
    /*    -------------  TEMPLATE -------- */
    // choose template type
    $wp_customize->add_setting("multidealer_template_gallery", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage", // 'refresh',
    ]);
    $wp_customize->add_control("multidealer_template_gallery", [
        "section" => "template name",
        "settings" => "multidealer_template_gallery",
        "type" => "radio",
        "label" => __("Template Name", "multidealer"),
        "description" => "",
        "choices" => [
            "yes" => "Gallery *",
            "list" => "List View",
            "grid" => "Grid",
        ],
    ]);
    function multidealer_customize_render_control($control)
    {
        ?>
			  <div>Template Grid is Pro. You can use, for free, Gallery and List View.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php
    }
    add_action(
        "customize_render_control_multidealer_template_gallery",
        "multidealer_customize_render_control"
    );
    //$section_id = "single_multi template name";
        // choose single multi template type
        $wp_customize->add_setting("multidealer_template_single", [
            "default" => "1",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
        $wp_customize->add_control("multidealer_template_single", [
            "section" => "single_multi_template_name",
            "settings" => "multidealer_template_single",
            "type" => "radio",
            "label" => __("Single Multi Template Name", "multidealer"),
            "description" => "",
            "choices" => [
                '1'=> 'Model 1 (free)',
				'2'=> 'Model 2 (with sidebar) (pro)',
            ],
        ]);
        // choose single multi template type
        $wp_customize->add_setting("multidealer_modal_size", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
        /*
        $wp_customize->add_control("multidealer_modal_size", [
            "section" => "single_multi_template_name",
            "settings" => "multidealer_modal_size",
            "type" => "radio",
            "label" => __("Single Multi Template Pop Up Modal Width", "multidealer"),
            "description" => "",
            "choices" => [
                '1'=> '800 px',
				'2'=> '900 px',
				'3'=> '1000 px',
            ],
        ]);
        */
    //Text template page Color
    $wp_customize->add_setting("multidealer-plugin-template-fg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-fg-color", [
        "label" => __("Template Text Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-fg-color",
        "type" => "color",
    ]);
    //Background template page
    $wp_customize->add_setting("multidealer-plugin-template-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-bk-color", [
        "label" => __("Template Background Color (works with templates gallery and list view)", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-bk-color",
        "type" => "color",
    ]);
    //Text template title Color
    $wp_customize->add_setting("multidealer-plugin-template-title-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-title-color", [
        "label" => __("Template Title Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-title-color",
        "type" => "color",
    ]);
    //View Button Color
    $wp_customize->add_setting("multidealer-plugin-template-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-button-color", [
        "label" => __("Template Button View Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-button-color",
        "type" => "color",
    ]);
    //View Button Background Color
    $wp_customize->add_setting("multidealer-plugin-template-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-button-bkg-color", [
        "label" => __("Template Button View Background Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-button-bkg-color",
        "type" => "color",
    ]);
    //View Button round
    $wp_customize->add_setting("multidealer-plugin-template-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-button-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    //View Button width
    $wp_customize->add_setting("multidealer-plugin-template-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-button-width", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Width" ,"multidealer"),
        "description" => __("Button width: from 100 to 300.","multidealer"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    //Theme List View Separator
    $wp_customize->add_setting("multidealer-plugin-template-list-separator", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-list-separator", [
        "label" => __("Template List View Separator Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-list-separator",
        "type" => "color",
    ]);
    //Theme Grid Border
    $wp_customize->add_setting("multidealer-plugin-template-grid-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    // grid border ...
    $wp_customize->add_control("multidealer-plugin-template-grid-border", [
        "label" => __("Template Grid Border Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-grid-border",
        "type" => "color",
    ]);
    //Theme Gallery Border color
    $wp_customize->add_setting("multidealer-plugin-template-gallery-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-gallery-border", [
        "label" => __("Template Gallery and Widgets Border Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-gallery-border",
        "type" => "color",
    ]);
    //Theme Gallery Border color
    $wp_customize->add_setting("multidealer-plugin-template-gallery-border-radius", [
        "default" => "5",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-gallery-border-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Gallery and Widgets Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    $wp_customize->add_setting("multidealer-plugin-template-gallery-title", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-gallery-title", [
        "label" => __("Template Gallery and Widgets Title Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-template-gallery-title",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-template-gallery-title-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-gallery-title-bkg", [
        "label" => __(
            "Template Gallery and Widgets Title Background Color",
            "multidealer"
        ),
        "section" => "template",
        "settings" => "multidealer-plugin-template-gallery-title-bkg",
        "type" => "color",
    ]);
    $wp_customize->add_setting("multidealer-plugin-widget-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-widget-bkg", [
        "label" => __("Widget Search Background Color", "multidealer"),
        "section" => "template",
        "settings" => "multidealer-plugin-widget-bkg",
        "type" => "color",
    ]);
    /*    -------------  END TEMPLATE -------- */
    /*    -------------  SINGLE Multi -------- */
    //single Background
    $wp_customize->add_setting("multidealer-plugin-template-single-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-single-bk-color", [
        "label" => __("Single Multi Template Background Color (works with templates 1 and 4", "multidealer"),
        "section" => "template-single",
        "settings" => "multidealer-plugin-template-single-bk-color",
        "type" => "color",
    ]);
    //single color
    $wp_customize->add_setting("multidealer-plugin-template-single-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-single-color", [
        "label" => __("Single Multi Template Color", "multidealer"),
        "section" => "template-single",
        "settings" => "multidealer-plugin-template-single-color",
        "type" => "color",
    ]);
    // features background
    $wp_customize->add_setting("multidealer-plugin-template-single-features-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-single-features-bkg", [
        "label" => __(
            "Single Multi Template Features Title Background Color",
            "multidealer"
        ),
        "section" => "template-single",
        "settings" => "multidealer-plugin-template-single-features-bkg",
        "type" => "color",
    ]);
    //features color
    $wp_customize->add_setting("multidealer-plugin-template-single-features-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-template-single-features-color", [
        "label" => __("Single Multi Template Features Title Color", "multidealer"),
        "section" => "template-single",
        "settings" => "multidealer-plugin-template-single-features-color",
        "type" => "color",
    ]);
    //features Border
    $wp_customize->add_setting(
        "multidealer-plugin-template-single-features-border-color",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );
    $wp_customize->add_control(
        "multidealer-plugin-template-single-features-border-color",
        [
            "label" => __(
                "Single Multi Template Features Border Color",
                "multidealer"
            ),
            "section" => "template-single",
            "settings" => "multidealer-plugin-template-single-features-border-color",
            "type" => "color",
        ]
    );
    // Border radius
    $wp_customize->add_setting(
        "multidealer-plugin-template-single-features-border-radius",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );
    $wp_customize->add_control(
        "multidealer-plugin-template-single-features-border-radius",
        [
            "type" => "range",
            "section" => "template-single",
            "label" => __("Features Border Radius","multidealer"),
            "description" => __("Features Border Radius: from 0 to 30.","multidealer"),
            "settings" => "multidealer-plugin-template-single-features-border-radius",
            "input_attrs" => [
                "min" => 0,
                "max" => 30,
                "step" => 1,
            ],
        ]
    );
    /*    -------------  END SINGLE Multi -------- */
    // Layout
    //Search Background
    $wp_customize->add_setting("multidealer-plugin-search-box-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-box-bk-color", [
        "label" => __("Background Color", "multidealer"),
        "section" => "search Box",
        "settings" => "multidealer-plugin-search-box-bk-color",
        "type" => "color",
    ]);
    // Border size
    $wp_customize->add_setting("multidealer-plugin-search-box-border-size", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-box-border-size", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Size","multidealer"),
        "description" => __(
            "Border Size: from 0 to 5. Mark 0 to hide the Boarder.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 5,
            "step" => 1,
        ],
    ]);
    // Border radius
    $wp_customize->add_setting("multidealer-plugin-search-box-border-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-box-border-radius", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Radius","multidealer"),
        "description" => __("Border Radius: from 1 to 70px.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    //Search Border Color
    $wp_customize->add_setting("multidealer-plugin-search-box-border-color", [
        "default" => "#cccccc",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-box-border-color", [
        "label" => __("Border Color", "multidealer"),
        "section" => "search Box",
        "settings" => "multidealer-plugin-search-box-border-color",
        "type" => "color",
    ]);
    // Margin Bottom
    $wp_customize->add_setting("multidealer-plugin-search-box-margin-bottom", [
        "default" => "25",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-search-box-margin-bottom", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Margin Bottom","multidealer"),
        "description" => __("Margin Bottom: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 70,
            "step" => 1,
        ],
    ]);
    // end layout
    /*    -------------  Go Back and Contact Us BUTTONs -------- */
    //Button Color
    $wp_customize->add_setting("multidealer-plugin-back-contact-buttons-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-back-contact-buttons-color", [
        "label" => __("Back and Contact Us Buttons Color", "multidealer"),
        "section" => "back-contact-us",
        "settings" => "multidealer-plugin-back-contact-buttons-color",
        "type" => "color",
    ]);
    //Button Background
    $wp_customize->add_setting("multidealer-plugin-back-contact-buttons-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("multidealer-plugin-back-contact-buttons-bk-color", [
        "label" => __(
            "Back and Contact Us Buttons Background Color",
            "multidealer"
        ),
        "section" => "back-contact-us",
        "settings" => "multidealer-plugin-back-contact-buttons-bk-color",
        "type" => "color",
    ]);
    //multidealer-plugin-back-contact-buttons-width
    $wp_customize->add_setting("multidealer-plugin-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "multidealer_my_custom_callback", // sua callback function personalizada
    ]);
    $wp_customize->add_control("multidealer-plugin-back-contact-buttons-width", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons width","multidealer"),
        "description" => __("Border Radius: from 100 to 300.","multidealer"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);
    $wp_customize->add_setting("multidealer-plugin-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "multidealer_my_custom_callback", // sua callback function personalizada
    ]);
    //multidealer-plugin-back-contact-buttons-radius
    $wp_customize->add_setting("multidealer-plugin-back-contact-buttons-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "multidealer_my_custom_callback", // sua callback function personalizada
    ]);
    $wp_customize->add_control("multidealer-plugin-back-contact-buttons-radius", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons Border Radius","multidealer"),
        "description" => __("Border Radius: from 0 to 30.","multidealer"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);
    function multidealer_my_custom_callback($value)
    {
        // código para tratar as atualizações do setting
    }
    /*    -------------  END BUTTONS -------- */
}
add_action("customize_register", "multidealer_plugin_customize_register", 11);
