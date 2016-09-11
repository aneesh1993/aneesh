<?php

	require(__DIR__.'\PHPMailer-master\PHPMailer-master\class.phpmailer.php');
	require(__DIR__.'\PHPMailer-master\PHPMailer-master\PHPMailerAutoload.php');
	include 'my_password.php';
	
	$name = $_GET['name']; // required
	$surname = $_GET['surname']; // required
	$email = $_GET['email']; // required
	$phone = $_GET['phone']; // not required
	$message = $_GET['message']; // required
	
	$recepient = "aneesh1993@gmail.com";
	
	$mail = new PHPMailer();

	//$mail->SMTPDebug = true;

	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";
	$mail->IsSMTP();

	$mail->SMTPAuth = true; 					// enable SMTP authentication
	$mail->SMTPSecure = "tls"; 					//"ssl"; // sets the prefix to the servier

	$mail->Host = "smtp.gmail.com"; 			// sets GMAIL as the SMTP server
	$mail->Port = 587; 							// set the SMTP port for the GMAIL server

	$mail->Username = "portfoliowebsite1993@gmail.com"; 	// GMAIL username
	$mail->Password = $password; 				// GMAIL password

	$mail->From = "portfoliowebsite1993@gmail"; 		// "name@yourdomain.com";
	$mail->FromName = "Mr. ".$name;		  		// set from Name
	$mail->Subject = "Message From Website"; 
	$mail->Body = "From: ".$name." ".$surname." Email: ".$email." Phone: ".$phone." Message: ".$message;
	
	$mail->AddAddress($recepient);
	
	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	if(!$mail->Send()) {
		echo 'Sorry, we cant send your message at this time! Please try again later.';
		//echo 'Mailer error: ' . $mail->ErrorInfo;
	} 
	else {
		echo 'Your message has been sent. I will get back to you as soon as possible!';
	}
?>


