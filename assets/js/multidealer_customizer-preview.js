(function($) {

    // console.log('9000');
    $(document).ready(function() {




        $(document).click(function(event) {

            // console.log('Elemento clicado:'+ event.target);
            // const url =  event.target;
            const target = event.target;

            if (target.tagName === 'A') {

                const url = event.target.href;

                // console.log(typeof url);
                // console.log('string:'+ url);
                

                // Check if the value is a valid URL
                if (typeof url === 'string' && url.startsWith('http')) {
                    // Create a new URL object
                    const parsedUrl = new URL(url);

                    // console.log('Passou:');
                    
                    var urlProper = parsedUrl.origin + parsedUrl.pathname;
                    const hasCustomizeChangeset = parsedUrl.searchParams.has('customize_changeset_uuid');
                    const hasCustomizeMessengerChannel = parsedUrl.searchParams.has('customize_messenger_channel');
                    if (hasCustomizeChangeset && hasCustomizeMessengerChannel) {
                        // console.log('A URL contém os parâmetros customize_changeset e customize_messenger_channel!!!.');
                        const urlCookie = multidealer_getCookie('multidealer_url');
                        if (urlCookie !== null) {
                            // console.log('Tem cookie 1 '+urlCookie);
                            document.cookie = 'multidealer_url' + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                        }
                        multidealer_setUrlCookie(urlProper);
                        // console.log('Tem cookie 2 '+urlCookie);
                    } 
                }
            }

        });

        /*    Search Box   */
        // Search BKG color
        wp.customize('multidealer-plugin-search-box-bk-color', function(value) {
            value.bind(function(new_value) {
                console.log('bkg: ' + new_value);
                // Update preview
                $('.MultiDealer-search-box').css("background-color", new_value);
            });
        });
        wp.customize('multidealer-plugin-search-box-border-color', function(value) {
            value.bind(function(new_value) {
                // Update preview
                $('.MultiDealer-search-box').css("border-color", new_value);
            });
        });
        // Search Border Size
        wp.customize('multidealer-plugin-search-box-border-size', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px";
                $('.MultiDealer-search-box').css("border-width", $set_border);
            });
        });
        // Search Border Radius
        wp.customize('multidealer-plugin-search-box-border-radius', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px";
                $('.MultiDealer-search-box').css("border-radius", $set_border);
            });
        });
        // Margin Bottom
        wp.customize('multidealer-plugin-search-box-margin-bottom', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_margin = new_value + "px";
                $('.MultiDealer-search-box').css("margin-bottom", $set_margin);
            });
        });
        /*    End Search Box   */
        /*    Search Fields   */
        wp.customize('multidealer-plugin-search-fields-label-color', function(value) {
            value.bind(function(new_value) {
                $('.MultiDealer-search-label').css("color", new_value);
                $('.MultiDealer-search-label-widget').css("color", new_value);
            });
        });
        // .MultiDealer-select-box-meta
        wp.customize('multidealer-plugin-search-fields-control-color', function(value) {
            value.bind(function(new_value) {
                $('.MultiDealer-select-box-meta').css("color", new_value);
                $('.MultiDealer-select-box-meta-widget').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-search-fields-control-bkg-color', function(value) {
            value.bind(function(new_value) {
                $('.MultiDealer-select-box-meta').css("background", new_value);
                $('.MultiDealer-select-box-meta-widget').css("background", new_value);
            });
        });
        //multidealer-plugin-search-fields-radius
        wp.customize('multidealer-plugin-search-fields-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('.MultiDealer-select-box-meta').css("border-radius", $set_border);
                $('.MultiDealer-select-box-meta-widget').css("border-radius", $set_border);
            });
        });
        /*    End Search Fields   */
        // submitBtn
        wp.customize('multidealer-plugin-search-button-color', function(value) {
            value.bind(function(new_value) {
                $('#MultiDealer-submitBtn').css("color", new_value);
                $('#MultiDealer-submitBtn-widget').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-search-button-bkg-color', function(value) {
            value.bind(function(new_value) {

                $('#MultiDealer-submitBtn').css("background", new_value);
                $('#MultiDealer-submitBtn-widget').css("background", new_value);
            });
        });
        //multidealer-plugin-search-button-radius
        wp.customize('multidealer-plugin-search-button-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('#MultiDealer-submitBtn').css("border-radius", $set_border);
                $('#MultiDealer-submitBtn-widget').css("border-radius", $set_border);
            });
        });
                // multidealer-plugin-search-button-width
                wp.customize('multidealer-plugin-search-button-width', function(value) {
                    value.bind(function(new_value) {
                        var $set_width = new_value + "px";
                        $('#MultiDealer-submitBtn').css("width", $set_width);
                    });
                });  
        // Slider
        // .MultiDealer-select-box-meta
        wp.customize('multidealer-plugin-search-slider-label-color', function(value) {
            value.bind(function(new_value) {
                // console.log(new_value);
                $('.multidealerlabelprice').css("color", new_value);
                $('#meta_price').css("color", new_value);
                $('.multidealerlabelprice2').css("color", new_value);
                $('#meta_price2').css("color", new_value);
                /* >>>>>>>>>>>>>>>>>>>>  */
            });
        });
        wp.customize('multidealer-plugin-search-slider-control-bkg-color', function(value) {
            value.bind(function(new_value) {
                $('.multidealer-price-slider').css("background", new_value);
                $('.multidealer-price-slider2').css("background", new_value);
                $('#meta_price').css("color", new_value);
                $('#meta_price2').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-search-slider-control-color', function(value) {
            value.bind(function(new_value) {
                // console.log(new_value);
                $('.ui-slider .ui-slider-range').hide(); 
                $('.ui-widget.ui-widget-content').css("background-color", new_value);
              $('.ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active').css("background-color", new_value+' !important');
              $('.ui-state-default, .ui-widget-content .ui-state-default').css("background-color", new_value+' !important');
              $('.ui-slider .ui-slider-handle').css("background-color", new_value+' !important');
            });
        });
        wp.customize('multidealer-plugin-search-slider-handle-color', function(value) {
            value.bind(function(new_value) {
                $('#slider-button-0').css("background-color", new_value); 
                $('#slider-button-1').css("background-color", new_value); 
                $('#slider-button-2').css("background-color", new_value); 
                $('#slider-button-3').css("background-color", new_value); 
            });
        });
        wp.customize('multidealer-plugin-search-slider-border-color', function(value) {
            value.bind(function(new_value) {
                console.log('nv '+new_value);
                $('.multidealer-price-slider').css("border-color", new_value);
                $('.multidealer-price-slider2').css("border-color", new_value);
            });
        });
        wp.customize('multidealer-plugin-search-slider-radius', function(value) {
            value.bind(function(new_value) {
                var $set_border = new_value + "px";
                $('.multidealer-price-slider').css("border-radius", $set_border);
                $('.multidealer-price-slider2').css("border-radius", $set_border);
            });
        });
        // Template Single Multi
        //multidealer-plugin-template-single-bk-color
        wp.customize('multidealer-plugin-template-single-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#content2').css("background", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-single-color', function(value) {
            value.bind(function(new_value) {
                $('.multiContent').css("color", new_value);
                $('#content2').css("color", new_value);
                $('.featuredList').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-single-features-bkg', function(value) {
            value.bind(function(new_value) {
                $('.featuredTitle').css("background", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-single-features-color', function(value) {
            value.bind(function(new_value) {
                $('.featuredTitle').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-single-features-border-color', function(value) {
            value.bind(function(new_value) {
                $('.featuredMulti').css("border-color", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-single-features-border-radius', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "0px 0px "+new_value + "px "  + new_value + "px" ;
                var $set_border2 = new_value + "px "  + new_value + "px 0px 0px" ;
                $('.featuredMulti').css("border-radius", $set_border);
                $('.featuredTitle').css("border-radius", $set_border2);
            });
        });
        // .multidealer-plugin-back and contact
        wp.customize('multidealer-plugin-back-contact-buttons-color', function(value) {
            value.bind(function(new_value) {
                $('#multidealer_goback').css("color", new_value);
                $('#multidealer_cform').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-back-contact-buttons-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#multidealer_goback').css("background", new_value);
                $('#multidealer_cform').css("background", new_value);
            });
        });
        wp.customize('multidealer-plugin-back-contact-buttons-radius', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = new_value + "px";
                $('#multidealer_goback').css("border-radius", $set_border);
                $('#multidealer_cform').css("border-radius", $set_border);
            });
        });
		wp.customize('multidealer-plugin-back-contact-buttons-width', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = new_value + "px";
                $('#multidealer_goback').css("width", $set_border);
                $('#multidealer_cform').css("width", $set_border);
            });
        });

        
        // Change Template
        wp.customize('multidealer_template_gallery', function(value) {
            value.bind(function(new_value) {

                //console.log(new_value);

                var previewUrl = multidealer_my_data.multidealer_previewUrl;
                const ultimoSlashIndex = previewUrl.lastIndexOf("/");
                siteUrl = previewUrl.slice(0, ultimoSlashIndex + 1);
                
               // console.log(siteUrl);

                 if (new_value == 'list') {
                    $('#multi_dealer_content').html('<img src="'+siteUrl+'wp-content/plugins/multidealer/assets/images/list.jpg">');
                 }
                 else if (new_value == 'grid') {
                    $('#multi_dealer_content').html('<img src="'+siteUrl+'wp-content/plugins/multidealer/assets/images/grid.jpg">');
                }
                else {
                    $('#multi_dealer_content').html('<img src="'+siteUrl+'wp-content/plugins/multidealer/assets/images/gallery.jpg">');
                }


                $('#multi_dealer_content').css("margin-bottom", "50px");
            });
        });

        // Change Single Multi Template
        wp.customize('multidealer_template_single', function(value) {
            value.bind(function(new_value) {

                var previewUrl = multidealer_my_data.multidealer_previewUrl;
                const ultimoSlashIndex = previewUrl.lastIndexOf("/");
                siteUrl = previewUrl.slice(0, ultimoSlashIndex + 1);

                // console.log(siteUrl);
                //console.log(new_value);

                 if (new_value == '1') {
                    $('#multi_dealer_content').html('<img src="'+siteUrl+'wp-content/plugins/multidealer/assets/images/single-1.jpg">');
                 }
                 else{
                    $('#multi_dealer_content').html('<img src="'+siteUrl+'wp-content/plugins/multidealer/assets/images/single-2.jpg">');
                 }
                $('#multi_dealer_content').css("margin-bottom", "50px");
            });
        });


/* .MultiDealer-search-box-widget */

        // Template
        wp.customize('multidealer-plugin-template-bk-color', function(value) {
            value.bind(function(new_value) {
                $('#multi_dealer_content').css("background", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-title-color', function(value) {
            value.bind(function(new_value) {
                $('.multiTitle17').css("color", new_value);
               // $('.multiInforightText17').css("color", new_value);
            });
        });
        wp.customize('multidealer-plugin-template-fg-color', function(value) {
            value.bind(function(new_value) {
                $('.multidealer_description').css("color", new_value);
                $('#multi_dealer_content').css("color", new_value);
                $('.multiInforightText17').css("color", new_value);

            });
        });
            // .multidealer-plugin-Button View
            wp.customize('multidealer-plugin-template-button-color', function(value) {
                value.bind(function(new_value) {
                    $('.multidealer_btn_view').css("color", new_value);
                });
            });
            wp.customize('multidealer-plugin-template-button-bkg-color', function(value) {
                value.bind(function(new_value) {
                    var new_value99 = new_value + ' !important';
                    var count = $('[id^="multidealer_btn_view-"]').length;
                    for (let i = 1; i <= count; i++) {
                        let elementId = "#multidealer_btn_view-" + i;
                        $(elementId).css("background", new_value);
                    }
                });
            });
            wp.customize('multidealer-plugin-template-button-radius', function(value) {
                value.bind(function(new_value, event) {
                    var $set_border = new_value + "px";
                    var count = $('[id^="multidealer_btn_view-"]').length;
                    for (let i = 1; i <= count; i++) {
                        let elementId = "#multidealer_btn_view-" + i;
                        let elementId2 = ".multidealer_btn_view-" + i;
                        $(elementId).css("border-radius", $set_border);
                        $(elementId2).css("border-radius", $set_border);
                    }
                });
            });
            wp.customize('multidealer-plugin-template-button-width', function(value) {
                value.bind(function(new_value, event) {
                    var $set_width = new_value + "px";
                    $('.multidealer_btn_view').css("width", $set_width);
                });
            });
   // .multidealer_container17
   wp.customize('multidealer-plugin-template-list-separator', function(value) {
        value.bind(function(new_value, event) {
            var $set_border = "1px solid "+new_value;
            $('.multidealer_container17').css("border-bottom", $set_border);
        });
    });
    // Gallery Title
    wp.customize('multidealer-plugin-template-gallery-title', function(value) {
        value.bind(function(new_value, event) {
            $('.multiTitle').css("color", new_value);
            $('.sideTitle').css("color", new_value);
            $('.multiTitle-widget').css("color", new_value);
        });
    });
    wp.customize('multidealer-plugin-template-gallery-title-bkg', function(value) {
        value.bind(function(new_value, event) {
            $('.multiTitle').css("background", new_value);
            $('.sideTitle').css("background", new_value);
            $('.multiTitle-widget').css("background", new_value);
        });
    });


    // Gallery Border  Radius
        wp.customize('multidealer-plugin-template-gallery-border-radius', function(value) {
            value.bind(function(new_value) {
                // Update preview
                var $set_border = new_value + "px " +  new_value + "px " + "0px 0px" ;
                $('.multidealer_gallery_2016').css("border-radius", $set_border);
                $('.sideTitle').css("border-radius", $set_border);
                $('.multidealer_caption_img').css("border-radius", $set_border);
                $('.multidealer_caption_text').css("border-radius", $set_border);
                // $("p#44.test").css("background-color","red");
            });
        });
        wp.customize('multidealer-plugin-template-gallery-border', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "1px solid " +  new_value;
                $('.multidealer_gallery_2016').css("border", $set_border);
                $('.multidealer_gallery_2016_widget').css("border", $set_border);
                
                $('.MultiDealer-search-box-widget').css("border", $set_border);
            });
        });
        wp.customize('multidealer-plugin-template-grid-border', function(value) {
            value.bind(function(new_value, event) {
                var $set_border = "1px solid " +  new_value;
                $('.multidealer-plugin-item-grid').css("border", $set_border);
            });
        });
        // Test Site Title...
        wp.customize('myplugin_setting', function(value) {
            value.bind(function(new_value) {
                if (new_value == '1') {
                    $('.site-title-text').hide();
                } else {
                    $('.site-title-text').show();
                }
            });
        });
        wp.customize('multidealer-plugin-widget-bkg', function(value) {
            value.bind(function(new_value, event) {
                console.log(new_value);
                $('.MultiDealer-search-box-widget').css("background", new_value);
            });
        });
});  // end doc ready...

    function multidealer_setUrlCookie(url) {
        document.cookie = `multidealer_url=${encodeURIComponent(url)+ "; path=/"}`;
      }
      if (typeof multidealer_getCookie !== 'function') {
        function multidealer_getCookie(name) {
            const cookieString = document.cookie;
            const cookies = cookieString.split(';');
            for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
            }
            return null;
        }
    }
})(jQuery);