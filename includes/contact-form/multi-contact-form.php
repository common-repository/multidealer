<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function multiDealer_contact_form()
{
     wp_enqueue_script('contact-form-js', MULTIDEALERURL . 'includes/contact-form/js/multi-contact-form.js', array('jquery'));   
} 
add_action('wp_loaded', 'multiDealer_contact_form');
function multidealer_form_ajaxurl()
{
        echo '<script type="text/javascript">
                var ajaxformurl = "' . esc_url(admin_url('admin-ajax.php')) . '";
              </script>';
}
add_action('wp_head', 'multidealer_form_ajaxurl');
add_action('wp_ajax_md_process_form', 'multiDealer_process_form_callback');
function multiDealer_process_form_callback()
{
    check_ajax_referer( 'multidealer_cform'); // , 'security', false );
    $Car_name = isset($_POST['multidealer_the_title']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['multidealer_the_title'])) : "";
    define("MULTIDEALERRECIPIENT_NAME", "WordPress");
    define("MULTIDEALEREMAIL_SUBJECT", "Visitor Message From MultiDealer Plugin About: ".$Car_name);
    $success = false;
    $recipient_email = isset($_POST['multidealer_recipientEmail']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['multidealer_recipientEmail'])) : "";
    $senderName = isset($_POST['multidealer_senderName']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['multidealer_senderName'])) : "";
    $senderEmail = isset($_POST['multidealer_senderEmail']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/",
        "", sanitize_text_field($_POST['multidealer_senderEmail'])) : "";
    if (isset($_POST['title']))
       $message = sanitize_text_field($_POST['title'].PHP_EOL);
    else
       $message = 'Message: ';
    $message .= isset($_POST['multidealer_sendermessage']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/",
        "", sanitize_text_field($_POST['multidealer_sendermessage'])) : "";
    if ($senderName && $senderEmail && $message && $recipient_email) {
        $recipient = MULTIDEALERRECIPIENT_NAME . " <" . $recipient_email . ">";
   

        $mydomain = preg_replace('/www\./i', '', sanitize_text_field($_SERVER['SERVER_NAME']));
        $message = 'eMail: ' . $senderEmail . PHP_EOL . $message;
        $message = 'Name: ' . $senderName . PHP_EOL . $message;



    $headers = "From: WordPress Site < WordPress@" . $mydomain . " >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
 //   $headers .= "Return-Path: mail@domain.com\n"; // Return path for errors
        $success = mail($recipient_email, MULTIDEALEREMAIL_SUBJECT, $message, $headers);
    }
    echo $success ? "success" : "error";
    die();
} 
?>