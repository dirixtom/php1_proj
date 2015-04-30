<?php  
	$contactemail = "rentastudentthomasmore@gmail.com";
	$visit = true;
	$sendmail = false;

	if($visit == true) {
		$sendmail = false;
	} else {
		$sendmail = true;
	}

	if($sendmail == true) {
		$to = $email; 
        $bcc = $contactemail; 

        $subject = "Rate your buddy and leave some feedback."; 
        $message = "Lorem ipsumtekstje"; 


        $from = 'From: rentastudentthomasmore@gmail.com'; 

        mail($to, $subject, $message, $from); 
        mail($bcc, $subject, $message, $from); 
	}

?>