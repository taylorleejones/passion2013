<?php
	$email_to = "passion2013@268mail.com";
	$fromname = $_POST["_name"];
    $email_subject = "Feedback Form from $fromname :: Passion Live Stream";
    $from_email = $_POST["_email"];
    $email_message = $_POST["_message"] . "\r\n FROM: $from_email";
    if ($email_message != "" && $from_email != ""){$valid = true; } else {$valid = false; }
	if ($valid){
		// send mail
	
	$headers .= 'From: '. $fromname ."_guest@268generation.com" ."\r\n".
		'Reply-To:' . $from_email ."\r\n";
	$headers .= "Organization: Passion Livestream\r\n";
  	$headers .= "MIME-Version: 1.0\r\n";
  	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  	$headers .= "X-Priority: 3\r\n";
  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
		if (@mail($email_to, $email_subject, $email_message, $headers)){
			echo 1;
		} else {
			echo -1;
		};

	} else {
		// don't send mail
		echo 0;
		die();
	}
?>