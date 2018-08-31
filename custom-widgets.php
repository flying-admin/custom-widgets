<?php

/*
Plugin Name: Custom Widgets for SiteOrigin
Description: Custom Widgets for SiteOrigin Widgets Bundle
Version: 1.0
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

function custom_widgets ($folders){
	$folders[] = plugin_dir_path(__FILE__).'widgets/';
	return $folders;
}
add_filter( 'siteorigin_widgets_widget_folders', 'custom_widgets' );
add_action( 'init', 'init_cta_form_send_form' );

function init_cta_form_send_form (){
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["action"]) ) {
		if ($_REQUEST["action"] == "ie_exec_cta_formulario"){

			  // Get the form fields and remove whitespace.
         $name = strip_tags(trim($_POST["emaildata"]['username']));
         $name = str_replace(array("\r","\n"),array(" "," "),$name);
         $userlastname = strip_tags(trim($_POST["emaildata"]['userlastname']));
         $userlastname = str_replace(array("\r","\n"),array(" "," "),$userlastname);
         $name .= " ".$userlastname;
         $email = filter_var(trim( $_POST["emaildata"]['usermail'] ), FILTER_SANITIZE_EMAIL);
         $message = trim( $_POST["emaildata"]['usermessage']);


        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        
        // Set the recipient email address.
        $recipient = $_POST["emaildata"]['sendto'];
        // Set the email subject.
        $subject = "Fomulario: ".$_POST["emaildata"]['eventtopic'];

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n\n";
        $email_content .= "Mesasge info: \n eventurl: ".$_POST["emaildata"]['eventurl']."\n eventtopic: ".$_POST["emaildata"]['eventtopic'];

				wp_mail( $recipient, $subject ,$email_content , "",array() );
			
			exit();
		}
	}
}