<?php

//echo "{ uno:'hola' }";

// Only process POST reqeusts.
    if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
      echo " ";
        // // Get the form fields and remove whitespace.
        //  $name = strip_tags(trim($_POST["emaildata"]['username']));
        //  $name = str_replace(array("\r","\n"),array(" "," "),$name);
        //  $userlastname = strip_tags(trim($_POST["emaildata"]['userlastname']));
        //  $userlastname = str_replace(array("\r","\n"),array(" "," "),$userlastname);
        //  $name .= " ".$userlastname;
        //  $email = filter_var(trim( $_POST["emaildata"]['usermail'] ), FILTER_SANITIZE_EMAIL);
        //  $message = trim( $_POST["emaildata"]['usermessage']);


        // // Check that data was sent to the mailer.
        // if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     // Set a 400 (bad request) response code and exit.
        //     http_response_code(400);
        //     echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        //     exit;
        // }

        
        // // Set the recipient email address.
        // $recipient = $_POST["emaildata"]['sendto'];
        // // Set the email subject.
        // $subject = $_POST["action"];

        // // Build the email content.
        // $email_content = "Name: $name\n";
        // $email_content .= "Email: $email\n\n";
        // $email_content .= "Message:\n$message\n\n";
        // $email_content .= "Mesasge info: \n eventurl: ".$_POST["emaildata"]['eventurl']."\n eventtopic: ".$_POST["emaildata"]['eventtopic'];

        // // // Build the email headers.
        // // $email_headers = "From: $name <$email>";
        // $headers="MIME-Version: 1.0; Content-Type: text/plain; charset=utf-8; From: IE ";

      

        // //mail( "cristinagomezcasares@gmail.com", "el asunto mail" ,$email_content , $headers );
        // wp_mail( "cristinagomezcasares@gmail.com", "el asunto" ,$email_content , $headers );
        // // Send the email.
        // //if  (mail($recipient, $subject, $email_content, $email_headers)) {
        // // if ( ) {
        // //     // Set a 200 (okay) response code.
        // //     http_response_code(200);
        // //     echo "Thank You! Your message has been sent.";
        // // } else {
        // //     // Set a 500 (internal server error) response code.
        // //     echo "Oops! Something went wrong and we couldn't send your message.";
        // // }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }


  //     ["action"]=>
  // string(22) "ie_exec_cta_formulario"
  // ["emaildata"]=>
  // array(7) {
  //   ["usermail"]=>
  //   string(11) "cirs@uno.es"
  //   ["username"]=>
  //   string(4) "cris"
  //   ["userlastname"]=>
  //   string(4) "cris"
  //   ["usermessage"]=>
  //   string(6) "dfgsfd"
  //   ["sendto"]=>
  //   string(8) "$fp_ctaf"
  //   ["eventurl"]=>
  //   string(101) "wp-test.flyingpigs.es/cris-dev/?preview_id=208&preview_nonce=0201a87d26&_thumbnail_id=-1&preview=true"
  //   ["eventtopic"]=>
  //   string(8) "cris-dev"
  // }
?>