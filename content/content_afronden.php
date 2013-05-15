<?php 
    {
        if(isset($_SESSION['klant_id']))
        {
            include 'connect.php';
            include 'class.phpmailer.php';

        	$username = $_SESSION['user_name'];
            $klant_id = $_SESSION['klant_id'];
            $totaalprijs = 0;
            $totaalproducten = 0;

            $datum = date("Y-m-d H:i:s");

            // bestellingen
            $query = "INSERT INTO bestellingen (klant_id, best_datum) VALUES ('$klant_id', '$datum')"; 
            mysql_query($query) or die (mysql_error());

            // het verkrijgen van het bestelling_id
            $bestelling_id = mysql_insert_id();

            $cookie = $_COOKIE["wkwebshop_$username"];
            $vars = explode(";", $cookie);
            $counter = 0;
            
            while (count($vars) > $counter) 
            {
                $query = "SELECT * FROM artikelen WHERE artikel_id = ".$vars[$counter];
                $counter++;
                $resultaat = mysql_query($query) or die (mysql_error());
                
                while ($row = mysql_fetch_array($resultaat)) 
                {
                    $artikel_id = $row['artikel_id'];
                    $artikel_aantal = $vars[$counter];
                    $artikel_prijs = $row['artikel_prijs'];

                    $totaalprijs += $vars[$counter] * $row['artikel_prijs'];
                    $totaalproducten += $vars[$counter];

                    // bestelling regel
                    $query = "INSERT INTO bestelling_regel(bestelling_id, artikel_id, bestreg_artikel_prijs, bestreg_aantal) VALUES ($bestelling_id,$artikel_id, $artikel_prijs, $artikel_aantal)";
                    mysql_query($query) or die (mysql_error());
                }
                $counter++;
            } 
            echo 'Gefeliciteerd u heeft succesvol betaald. U krijgt een email met daarin de gegevens over uw bestelling.';
            
                    $email = "wkwebshop@gmail.com";

                    //user e-mail
                    $umail = $_POST["user_mail"];

                    // set datum 
                    $datum = date("d.m.Y H:i");
                    $tijd = date("H:i");

                    // set ip 
                    $ip = $_SERVER['REMOTE_ADDR'];

                    //opbouw mail 
                    $body = "<br />Verstuurd op " . $datum . " via het ip " . $ip . "<br /><br />";

                    $mail = new PHPMailer();

                    $mail->IsSMTP(); // send via SMTP
                    $mail->Host = "smtp.google.com";
                    $mail->Port = 587;
                    $mail->Mailer = "smtp";
                    $mail->SMTPAuth = true; // turn on SMTP authentication
                    $mail->SMTPSecure = "tls";
                    $mail->Username = "wkwebshop@gmail.com"; // SMTP username
                    $mail->Password = "wkwebshop123"; // SMTP password

                    $mail->SetFrom($email, $email);
                    $mail->AddAddress($umail, $umail);
                    $mail->Subject = "Uw bestelling bij WK webshop";
                    $mail->AltBody = "Er is een fout opgetreden.";
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



























            mysql_close($connect);     
        }
        else
        {
            echo 'U bent geen klant. Dit kan komen doordat uw account administrator rechten heeft.';
        }
    }
 ?>

