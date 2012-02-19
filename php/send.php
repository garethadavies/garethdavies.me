
<?php

if(isset($_POST['submit'])) 
{
	$to = "info@garethdavies.me";
	$subject = "Website submission";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
	
	if(isset($_POST['name']) && strlen($_POST['name']) > 0)
	{
     	if (isset($_POST['email']) && strlen($_POST['email']) > 8)
		{
			if(eregi($email_exp,$_POST['email']))
			{
				if (isset($_POST['message']) && strlen($_POST['message']) > 0) 
				{
					$name_field = clean_string($_POST['name']);
					$email_field = clean_string($_POST['email']);
					$message = clean_string($_POST['message']);
					 
					$body = "From: $name_field\n E-Mail: $email_field\n\n Message:\n $message";
					
					// create email headers
					$headers = 'From: '.$email_field."\r\n".
					'Reply-To: '.$email_field."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($to, $subject, $body, $headers);
					
					header( 'Location: http://www.madebygareth.co.uk/2011/contact/?sent=true' ) ;
				}
				else
				{
					echo "Please submit a message";
				}
			}
			else
			{
				echo "Please submit a valid email address";
			}
		}
		else
		{
			echo "Please submit your email address";
		}
    }
	else
	{
		echo "Please submit your name";
	}
} 
else 
{
	echo "blarg!";				
}

function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}