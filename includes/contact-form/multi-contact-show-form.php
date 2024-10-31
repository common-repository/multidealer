<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// $aurl = MultiDEALERURL . 'includes/contact-form/processForm.php';
$aurl = "#";
$multidealer_recipientEmail = trim(get_option('multidealer_recipientEmail', ''));
if ( ! is_email($multidealer_recipientEmail)) {
        $multidealer_recipientEmail = '';
        update_option('multidealer_recipientEmail', '');
    }
if (empty($multidealer_recipientEmail))
    $multidealer_recipientEmail = get_option('admin_email'); ?>
<?php Global $Multidealer_the_title; ?>  
<form id="multidealer_contactForm" style="display: none;">
<!-- action="<?php echo esc_attr($aurl); ?>" method="post"> -->
  <input type="hidden" name="multidealer_recipientEmail" id="multidealer_recipientEmail" value="<?php echo
esc_attr($multidealer_recipientEmail); ?>" />
  <input type="hidden" name="Multidealer_the_title" id="Multidealer_the_title" value="<?php echo esc_attr($Multidealer_the_title); ?>" />
  <h2><?php 
  echo esc_attr__('Request Information', 'multidealer'); 
  ?>...</h2>
  <ul>
    <li>
      <label for="multidealer_senderName" class="multidealer_contact" ><?php echo esc_attr__('Your Name',
'multidealer'); ?>:&nbsp;</label>
      <input type="text" name="multidealer_senderName" id="multidealer_senderName" placeholder="<?php echo
esc_attr__('Please type your name', 'multidealer'); ?>" required="required" maxlength="40" />
    </li>
    <li>
      <label for="multidealer_senderEmail" class="multidealer_contact"><?php echo esc_attr__('Your Email',
'multidealer'); ?>:&nbsp;</label>
      <input type="email" name="multidealer_senderEmail" id="multidealer_senderEmail" placeholder="<?php echo
esc_attr__('Please type your email', 'multidealer'); ?>" required="required" maxlength="50" />
    </li>
    <li>
      <label for="multidealer_sendermessage" class="multidealer_contact" style="padding-top: .5em;"><?php echo
esc_attr__('Your Message', 'multidealer'); ?>:&nbsp;</label>
      <textarea name="multidealer_sendermessage" id="multidealer_sendermessage" placeholder="<?php echo
esc_attr__('Please type your message', 'multidealer'); ?>" required="required"  maxlength="10000"></textarea>
    </li>
  </ul>
<br />
  <div id="formButtons">
    <input type="submit" id="multidealer_sendMessage" name="sendMessage" value="<?php echo
esc_attr__('Send', 'multidealer'); ?>" />
    <input type="button" id="multidealer_cancel" name="cancel" value="<?php echo esc_attr__('Cancel',
'multidealer'); ?>" />
  </div>
<?php  wp_nonce_field('Multidealer_cform'); ?> 
</form>
<div id="multidealer_sendingMessage" class="multidealer_statusMessage" style="display: none; z-index:999;" ><p><?php esc_attr_e('Sending your message. Please wait...' , 'multidealer' ); ?></p></div>
<div id="multidealer_successMessage" class="multidealer_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'Thanks for your message! We\'ll get back to you shortly.' , 'multidealer' ); ?></p></div>
<div id="multidealer_failureMessage" class="multidealer_statusMessage" style="display: none;  z-index:999;"><p><?php esc_attr_e( 'There was a problem sending your message. Please try again.' , 'multidealer' ); ?></p></div>
<div id="multidealer_email_error" class="multidealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please enter one valid email address.' , 'multidealer' ); ?></p></div>
<div id="multidealer_incompleteMessage" class="multidealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Please complete all the fields in the form before sending.' , 'multidealer' ); ?></p></div>
<div id="multidealer_name_error" class="multidealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Name Error. Use only alpha.' , 'multidealer' ); ?></p></div>
<div id="multidealer_message_error" class="multidealer_statusMessage" style="display: none; z-index:999;"><p><?php esc_attr_e( 'Message Error. Only Use only alpha and numbers.' , 'multidealer' ); ?> </p></div>