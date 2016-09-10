<?php

require('C:\wamp64\www\stockguru\PHPMailer-master\PHPMailer-master\class.phpmailer.php');
require('C:\wamp64\www\stockguru\PHPMailer-master\PHPMailer-master\PHPMailerAutoload.php');
include 'my_password.php';

$mail = new PHPMailer();
//////////////////////////////////////////////////////////////////////////
	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";
	$mail->IsSMTP();

	$mail->SMTPAuth = true; 					// enable SMTP authentication
	$mail->SMTPSecure = "tls"; 					//"ssl"; // sets the prefix to the servier

	$mail->Host = "smtp.gmail.com"; 			// sets GMAIL as the SMTP server
	$mail->Port = 587; 							// set the SMTP port for the GMAIL server

	$mail->Username = "aneesh1993@gmail.com"; 	// GMAIL username
	$mail->Password = $password; 				// GMAIL password

	$mail->From = "aneesh1993@gmail.com"; 		// "name@yourdomain.com";
	$mail->FromName = "Mr. Client";  		// set from Name
	$mail->Subject = "Message from Website";
	
	$mail->AddAddress("aneesh1993@gmail.com");
	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
	
//////////////////////////////////////////////////////////////////////////	
// configure
//$from = "aneesh1993@gmail.com";
//$sendTo = 'Demo contact form <demo@domain.com>';
//$subject = 'New message from contact form';
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in email
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

try
{
    $emailText = "You have new message from contact form\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }
	$mail->Body = $emailText;
	
    //mail($sendTo, $subject, $emailText, "From: " . $from);

	if($mail->Send())	
		$responseArray = array('type' => 'success', 'message' => $okMessage);
	else
		$responseArray = array('type' => 'danger', 'message' => $errorMessage);	
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
else {
    echo $responseArray['message'];
}