<?php 
	$username = $_SESSION['user_name'];

	include 'class.phpmailer.php';

	$query = "SELECT * FROM users u, klanten k WHERE u.klant_id = k.klant_id AND u.user_name = '$username'";

	$resultaat = mysql_query($query) or die (mysql_error()) ;

	while ($row = mysql_fetch_array($resultaat)) 
	{
		$klantemail = $row['klant_email'];
	}

		$toad = $username;

        //user e-mail
        $umail = $klantemail;

        // set datum 
        $datum = date("d.m.Y H:i");
        $tijd = date("H:i");

        // set ip 
        $ip = $_SERVER['REMOTE_ADDR'];

        //opbouw mail 
        $body = $_POST["message"] . "<br />Verstuurd op " . $datum . " via het ip " . $ip . "<br /><br />";

        $mail = new PHPMailer();

        $mail->IsSMTP(); // send via SMTP
        $mail->Host = "<smtp addres bijv: smtp.google.com>";
        $mail->Port = 587;
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = "tls";
        $mail->Username = "<e@mail here>"; // SMTP username
        $mail->Password = "<password>"; // SMTP password

        $mail->SetFrom($umail, $umail);
        $mail->AddAddress($toad, $toad);
        $mail->Subject = $_POST["subject"];
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);

        if (!$mail->Send())
        {
            $message = 'Mailer Error: ' . $mail->ErrorInfo;
        }
        else
        {
            $message = '<div class="srv_message_block"><p>The email has been sent.<br />
        A highly trained monkey is processing your e-mail as we speak.<br />
        Expect to hear from the monkey very soon.<br />
        Please click to go to the homepage: <a href="index.php">home</a></p>
        </div>';
        }
    }
}
































 ?>



Gefeliciteerd u heeft succesvol betaald.
U krijgt een email met daarin de gegevens over uw bestelling.