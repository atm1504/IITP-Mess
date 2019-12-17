<?php
function send_email($email,$subject,$msg,$headers){
// 	return (mail($email,$subject,$msg,$headers));
	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 4;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'tls://smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = "dscappsocietyiitp@gmail.com";                 // SMTP username
	$mail->Password = "appified@1504";                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	$mail->setFrom('hostel_affairs@iitp.ac.in', 'IIT Patna Hostel Team');
	$mail->addAddress($email);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('hostel_affairs@iitp.ac.in', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $msg;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	if(!$mail->send()) {
	   // echo 'Message could not be sent.';
	   // echo 'Mailer Error: ' . $mail->ErrorInfo;
	    return false;
	} else {
	  //  echo 'Message has been sent';
	    return true;
	}
}