<?php


//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
// extracting mail contents from the form - begin

      
$Title = $_POST['Title'];	  
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Company = $_POST['Company'];
// $Infotype = $_POST['Infotype'];
$Services = $_POST['Services'];
$Contents = $_POST['Contents'];
$Body = $Title."\r\n<p><br>".$Name."\r\n<p><br>".$Email. "\r\n<p><br>".$Company. "\r\n<p><br>";
$Body.= $Infotype. "\r\n<p><br>".$Services."\r\n<p><br>".$Contents;
$To  = 'neoworldmark@tutanota.com'; 

// message
$Message = "<html><head><title>My Feedback to Angelia </title></head><body>
  <p>The following is my feedback information about my inquiry about the services of Angelia. </p>". $Body. "</body></html>";

// Content-type header 
$Headers  = 'MIME-Version: 1.0' . "\r\n";
$Headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// $Headers .= "From: Mark Chen <neoworldmark@tutanota.com>" . "\r\n" .
//            "Reply-To: neoworldmark@tutanota.com" . "\r\n" .
//            "X-Mailer: PHP/" . phpversion();

$Headers .= "From:". $Name." <".$Email.">" . "\r\n" .
           "Reply-To: ".$Email."\r\n" .
           "X-Mailer: PHP/" . phpversion();
		   
		   
// Additional headers
// $Headers .= $To . "\r\n";
// $Headers .= $Name .$Email . "\r\n";



//  extracting mail contents from the form  - end
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // access
        $secretKey = '6LcaNcUUAAAAANJLum_cstMG_CnNhhbEwjB5ZKRe';
        $captcha = $_POST['g-recaptcha-response'];

        if(!$captcha){
          echo '<p class="alert alert-warning">Please check the captcha form.</p>';
          exit;
        }

// below are the original codes, to be commented out 
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/*
        # FIX: Replace this email with recipient email
        $mail_to = "demo@gmail.com";
        
        # Sender Data
        $subject = trim($_POST["subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo '<p class="alert alert-warning">Please complete the form and try again.</p>';
            exit;
        }
*/
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////



        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(intval($responseKeys["success"]) !== 1) {
          echo '<p class="alert alert-warning">Please check the captcha form.</p>';
        } else {
            
			
			
// below are the original codes, to be commented out 
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/*
			
			# Mail Content
            $content = "Name: $name\n";
            $content .= "Email: $email\n\n";
            $content .= "Phone: $phone\n";
            $content .= "Message:\n$message\n";

            # email headers.
            $headers = "From: $name <$email>";

*/
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


            # Send the email.
			
            // $success = mail($mail_to, $subject, $content, $headers);			
			$success = mail($To, $Services, $Message, $Headers);
			//echo $success;
			
            if ($success) {
                # Set a 200 (okay) response code.
                //http_response_code(200);
				
				//
				
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">';

echo "<HTML><HEAD><TITLE> Your feedback information is sent successfully ! </TITLE></HEAD>";
echo '<META content="text/html; charset=utf-8" http-equiv=Content-Type>';

echo "<table width=500 border='2'  align='center' cellspacing='0' cellpadding='1'> <tr><td width='500' bgcolor='#D8D8EB'> <H2 align=center>  Thank you !  <b> <font color='#CC3300'>".$Title."\r\n".$Name." </font></b>, Your inquiry is sent out successfully! We will anwer you within the next 24 hours. Meanwhile please check your email boxes, also the junk boxes, for new emails, in order to get your timely replies.  </H2></td></tr> ";
echo "<tr><td width='500' bgcolor='#D8D8EB'> <H1 align=center>  Your Angelia team </H1></td></tr></table><p>";
echo "<table width=134 border=0 align='center' cellpadding=0 cellspacing=0>
<tr><td width='100%' valign='top'><img src='../../zzz_img/common/AngeliaModem.png' width='134' height='34' alt='Angelia'></td></tr></table>";

echo "</BODY></HTML>"; 
				
                //echo '<p class="alert alert-success">Thank You! Your message has been sent.</p>';
				
				
				
            } else {
                # Set a 500 (internal server error) response code.
                http_response_code(500);
                echo '<p class="alert alert-warning">Oops! Something went wrong, we couldnt send your message.</p>';
            }
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo '<p class="alert alert-warning">There was a problem with your submission, please try again.</p>';
    }

?>
