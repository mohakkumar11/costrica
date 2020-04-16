<?php
if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
	require_once "../vendor/autoload.php";

	//PHPMailer Object
	$mail = new PHPMailer;

	//From email address and name
	$mail->From = "adventure@costaricavacationing.com";
	$mail->FromName = "adventure@costaricavacationing.com";

	//To address and name
	// $mail->addAddress("recepient1@example.com", "Recepient Name");
	$mail->addAddress("info@crvacationing.com"); //Recipient name is optional

	//Address to which recipient will reply
	$mail->addReplyTo( $email, "Reply");

	//CC and BCC
	// $mail->addCC("cc@example.com");
	$mail->addBCC("minio@clevergrit.com");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Travel Consultation";
	$mail->Body = "Name: <i>" . $name . "</i><br> Email: <i>" . $email . "</i><br> Contact No.: <i>" . $message . "</i>";
	$mail->AltBody = "Name: " . $name . "<br> Email: " . $email . "<br> Contact No.: " . $message . "";

	if(!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	    echo "Message has been sent successfully";
	}
}

/*if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
$to      = 'info@crvacationing.com, info@costaricavacationing.com, herminioyatarjr@gmail.com';
$subject = "Email from: " .$name;

// $headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers = 'From: info@crvacationing.com' . "\r\n" .
    'Reply-To: '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//send email
    mail($to, "adventure.costaricavacationing.com", "Here are the info: Name". $name . "  Email address " . $email . " Contact No.: " . $message, $headers);
}*/
?>