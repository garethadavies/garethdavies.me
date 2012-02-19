<?php include '../php/const.php'; ?>

<?php

/* live setting

/$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);

*/

/* local setting

/$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);

*/

$dir = getcwd();
$len = strlen($dir);
$pos = strrpos($dir, "/");
$name = substr($dir,$pos+1,$len);

$sent_message = '';

if(isset($_POST['submit'])) 
{
	$to = 'info@garethdavies.me';
	$subject = 'Website submission';
	$email_exp = '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$';
	
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
					
					$sent_message = '<h4>Your message has been sent. Thanks!</h4>';
				}
				else
				{
					$sent_message = '<p class="error">Please submit a message</p>';
				}
			}
			else
			{
				$sent_message = '<p class="error">Please submit a valid email address</p>';
			}
		}
		else
		{
			$sent_message = '<p class="error">Please submit your email address</p>';
		}
    }
	else
	{
		$sent_message = '<p class="error">Please submit your name</p>';
	}
}

function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}

?>

<?php // build the individual requests as above, but do not execute them
    $ch_head = curl_init($rootdir . 'php/head.php');
    $ch_header = curl_init($rootdir . 'php/header.php');
	$ch_nav = curl_init($rootdir . 'php/nav.php');
	$ch_footer = curl_init($rootdir . 'php/footer.php');
	$ch_end = curl_init($rootdir . 'php/end.php');
    curl_setopt($ch_head, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_header, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_nav, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_footer, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_end, CURLOPT_RETURNTRANSFER, true);
    
    // build the multi-curl handle, adding both $ch
    $mh = curl_multi_init();
    curl_multi_add_handle($mh, $ch_head);
    curl_multi_add_handle($mh, $ch_header);
	curl_multi_add_handle($mh, $ch_nav);
	curl_multi_add_handle($mh, $ch_footer);
	curl_multi_add_handle($mh, $ch_end);
    
    // execute all queries simultaneously, and continue when all are complete
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running);
    
    // all of our requests are done, we can now access the results
    $response_head = curl_multi_getcontent($ch_head);
    $response_header = curl_multi_getcontent($ch_header);
	$response_nav = curl_multi_getcontent($ch_nav);
	$response_footer = curl_multi_getcontent($ch_footer);
	$response_end = curl_multi_getcontent($ch_end);

	echo $response_head; ?>
</head>

<body id="<?=$name?>">

	<?php echo $response_header; ?>
        
        <?php echo $response_nav; ?>

			<h2>Contact</h2>
            
           	<p>Feel free to contact me with any comment or enquiry you have and I will get back to you as soon as possible. You can either contact me directly at <a href="mailto:info@garethdavies.me">info@garethdavies.me</a>, or use the web form below.</p>
            
            <?php echo $sent_message ?>
            
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" id="contactForm" autocomplete="off">
            
            	<fieldset><legend class="visuallyhidden">Enter your contact information and message</legend>
             
                <label for="name">Name</label>
				<input id="name" name="name" type="text" placeholder="What is your name?" required />
				
               	<label for="email">E-mail</label>
				<input id="email" name="email" type="email" placeholder="What is your email address?" required />
                
                <label for="message">Message</label>
				<textarea id="message" name="message" cols="110" rows="8" placeholder="Enter your message" required></textarea>
                
               	<input id="submit" name="submit" type="submit" value="Send Message" />
                
                </fieldset>
        
       		</form>

		<?php echo $response_footer; ?>
		
<?php echo $response_end; ?>       