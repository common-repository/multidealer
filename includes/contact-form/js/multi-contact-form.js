jQuery(document).ready(function() {
	var messageDelay = 3000;
	jQuery("#multidealer_sendMessage").click(function(evt) {
		evt.preventDefault();
		var multidealer_contactForm = jQuery(this);
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    	var uemail = jQuery('#multidealer_senderEmail').val();
		if (!jQuery('#multidealer_senderName').val() || !jQuery('#multidealer_senderEmail').val() || !jQuery('#multidealer_sendermessage').val()) {
            jQuery('#multidealer_incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
            multidealer_contactForm.fadeOut().delay(messageDelay).fadeIn();
			// jQuery('#multidealer_senderName').css('border', '1px solid red');
            return false;
    	} 
        else if(!re.test(uemail))
        {
              jQuery('#multidealer_email_error').fadeIn().delay(messageDelay).fadeOut();
              return false;
        }
  		var uname = jQuery('#multidealer_senderName').val();
        var umessage = jQuery('#multidealer_sendermessage').val();
        if(!onlyalpha (uname))
        {
           jQuery('#multidealer_name_error').fadeIn().delay(messageDelay).fadeOut();
           return false;     
        }
        /*
        if( ! alphanumeric(umessage) )
        {
           jQuery('#multidealer_message_error').fadeIn().delay(messageDelay).fadeOut();
           return false; 
        }
        * */
        
         umessage = sanitarize (umessage);       
        
        
        
        
        //else {
			jQuery('#multidealer_sendingMessage').fadeIn();
			multidealer_contactForm.fadeOut();
            var nonce = jQuery('#_wpnonce').val();
            form_content = jQuery('#multidealer_contactForm').serialize();
              jQuery.ajax({
                type: "POST",
				url: ajaxformurl,
				data: form_content + '&action=md_process_form' + '&security=' + _wpnonce,
				    timeout: 20000,
                    error: function(jqXHR, textStatus, errorThrown) {
                      // alert('errorThrown');
                  		jQuery('#multidealer_sendingMessage').hide();
                        multidealer_contactForm.fadeIn();
                        alert('Fail to Connect with Data Base (9).\nPlease, try again later.');
                    }, 
                success: submitFinished
			});          
		// }
		return false;
	});
	jQuery(init_multidealer_form);
	function init_multidealer_form() {
		jQuery('#multidealer_contactForm').hide(); //.submit( submitForm ).addClass( 'multidealer_positioned' );
		jQuery('#multidealer_sendingMessage').hide();
		jQuery('#multidealer_successMessage').hide();
		jQuery('#multidealer_failureMessage').hide();
		jQuery('#multidealer_incompleteMessage').hide();
		jQuery("#multidealer_cform").click(function() {
			jQuery('#multidealer_cform').hide();
			jQuery('#multidealer_contactForm').addClass('multidealer_positioned');
			jQuery('#multidealer_contactForm').css('opacity', '1');
			jQuery('#multidealer_contactForm').fadeIn('slow', function() {
				jQuery('#multidealer_senderName').focus();
			})
			return false;
		});
		// When the "Cancel" button is clicked, close the form
		jQuery('#multidealer_cancel').click(function() {
			jQuery('#multidealer_contactForm').fadeOut();
			jQuery('#content2').fadeTo('slow', 1);
            jQuery("#multidealer_cform").fadeIn()
		});
		// When the "Escape" key is pressed, close the form
		jQuery('#multidealer_contactForm').keydown(function(event) {
			if (event.which == 27) {
				jQuery('#multidealer_contactForm').fadeOut();
				jQuery('#content2').fadeTo('slow', 1);
                jQuery("#multidealer_cform").fadeIn()
			}
		});
	}
	function submitFinished(response) {
		response = jQuery.trim(response);
		jQuery('#multidealer_sendingMessage').fadeOut();
		if (response == "success") {
			jQuery('#multidealer_successMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#multidealer_senderName').val("");
			jQuery('#multidealer_senderEmail').val("");
			jQuery('#multidealer_sendermessage').val("");
			jQuery('#content2').delay(messageDelay + 1000).fadeTo('slow', 1);
			jQuery('#multidealer_contactForm').fadeOut();
            jQuery("#multidealer_cform").fadeIn()
		} else {
			jQuery('#multidealer_failureMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#multidealer_contactForm').delay(messageDelay + 1000).fadeIn();
		}
	}
	
function sanitarize(str) {
    var map = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
		"\"": "&quot;",
		"[": "&#91;",
		"]": "&#93;",
		"{": "&#123;",
		"}": "&#125;",
        "'": "&#39;" // ' -> &apos; for XML only
    };
    return str.replace(/[&<>"']/g, function(m) { return map[m]; });
}

    function alphanumeric(inputtext)
    {
         if( /[^a-zA-Z0-9]/.test( inputtext ) ) {
           return false;
         }
        return true;
    }
    function onlyalpha(inputtext)
    {
     if( /[^a-zA-Z ]/.test( inputtext ) ) {
       return false;
     }
      return true;
    }
}); // end jQuery ready
