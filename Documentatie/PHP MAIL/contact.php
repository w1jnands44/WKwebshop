<?php
include 'inc/header.inc.php';
include 'inc/class.phpmailer.php';

if (isset($_POST["send"]))
{
    $contactchk = check_contact_form($_POST["user_mail"], $_POST["subject"], $_POST["message"]);
    if (count($contactchk) == 0)
    {
        //give to adress
        $toad = "<waar naar toe>";

        //user e-mail
        $umail = $_POST["user_mail"];

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

if (!isset($message))
{
    ?>
    <div class="input_area"><div class="input_title">- Contact -</div>
        <p>
            If you are experiencing dificulties with the site or the content in any way.<br />
            Please feel free to contact us via this contact form.<br />
            Please enter your e-mail adress, a subject and of course a message explaining the problem.<br />
            Once you've done this, click the send button to send out the email to us.<br />
            One of our highly trained monkeys will then answer your questions ASAP.<br />
        </p>
        <form action="contact.php" method="post">
            <ul>
                <li>
                    <label for="user_mail">E-Mail:</label>
                    <input name="user_mail" type="text" size="104" />
                    <?php if(isset($contactchk["mail"])) echo '<a title="' . $contactchk["mail"] . '"><img src="img/site_specific/exclamation.png" alt="Error" /></a>'; elseif (!isset($contactchk["mail"]) && isset($_POST["send"])) echo '<a title="OK"><img src="img/site_specific/accept.png" alt="OK" /></a>'; ?>
                </li>
                <li>
                    <label for="subject">Subject:</label>
                    <input name="subject" type="text" size="104" />
                    <?php if(isset($contactchk["subject"])) echo '<a title="' . $contactchk["subject"] . '"><img src="img/site_specific/exclamation.png" alt="Error" /></a>'; elseif (!isset($contactchk["subject"]) && isset($_POST["send"])) echo '<a title="OK"><img src="img/site_specific/accept.png" alt="OK" /></a>'; ?>
                </li>
                <li>
                    <label for="message">Message:</label>
                </li>
                <li>
                    <textarea cols="87" rows="20" name="message" style="resize: none;"></textarea>
                    <?php if(isset($contactchk["mess"])) echo '<a title="' . $contactchk["mess"] . '"><img src="img/site_specific/exclamation.png" alt="Error" /></a>'; elseif (!isset($contactchk["mess"]) && isset($_POST["send"])) echo '<a title="OK"><img src="img/site_specific/accept.png" alt="OK" /></a>'; ?>
                </li>
                <li>
                    <input type="submit" name="send" value="Send" style="width:721px;"/>
                </li>
            </ul>
        </form>
    </div>

    <?php
}
else
{
    echo $message;
}

function check_contact_form($mail, $subject, $mess)
{
    $return = array();

    if (strlen($mail) > 500)
    {
        $return["mail"] = "E-mail address too long.";
    }
    elseif ($mail == null)
    {
        $return["mail"] = "Empty field!";
    }

    if ($subject == null)
    {
        $return["subject"] = "Empty field!";
    }

    if ($mess == null)
    {
        $return["mess"] = "Empty field!";
    }

    return $return;
}

include 'inc/footer.inc.php';
?>