<?php
require("class.phpmailer.php");
define( 'OWNER_EMAIL', 'admin@studio7saloncr.com' );
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "server151.web-hosting.com";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Username = "admin@studio7saloncr.com";  // SMTP username
$mail->Password = "05tOqFfn?(oP"; // SMTP password
$mail->From = "no-reply@studio7saloncr.com";
$mail->FromName = "Studio 7 Salon";
$mail->AddAddress(OWNER_EMAIL);
$mail->AddReplyTo($_POST['data']['email'], $_POST['data']['name']);
$mail->IsHTML(true);
/**
*
* actions
* 
*/
if( !isset( $_POST['submit'] ) || empty( $_POST['submit'] ) ) exit();
else {
    switch( $_POST['submit'] ) {
       /**
        *
        * contact form
        * 
        */
        case 'contact-form':
            $maillayoutfile = fopen("mailtemplatecontacto.html", "r") or die("Unable to open file!");
			$maillayout = fread($maillayoutfile, filesize("mailtemplatecontacto.html"));
			fclose($maillayoutfile);
            $mailbody = str_replace("{nombre}", $_POST['data']['name'], $maillayout);
            $mailbody = str_replace("{mensaje}", $_POST['data']['message'], $mailbody);
            $mailbody = str_replace("{correo}", $_POST['data']['email'], $mailbody);
            $mailbody = str_replace("{telefono}", $_POST['data']['phone'], $mailbody);
            $mail->Subject = $_POST['data']['subject'];
			$mail->Body    = $mailbody;
            $mail->Send();
        break;
       /**
        *
        * appointment form
        * 
        */
        case 'appointment-form':
        	$maillayoutfile = fopen("mailtemplatecita.html", "r") or die("Unable to open file!");
			$maillayout = fread($maillayoutfile, filesize("mailtemplatecita.html"));
			fclose($maillayoutfile);
            $mailbody = str_replace("{nombre}", $_POST['data']['name'], $maillayout);
            $mailbody = str_replace("{mensaje}", $_POST['data']['additional-notes'], $mailbody);
            $mailbody = str_replace("{correo}", $_POST['data']['email'], $mailbody);
            $mailbody = str_replace("{numero}", $_POST['data']['phone'], $mailbody);
            $mailbody = str_replace("{fechacita}", $_POST['data']['appointment-date'], $mailbody);
            $mailbody = str_replace("{horacita}", $_POST['data']['approximate-time'], $mailbody);
            $mail->Subject = 'Cita Solicitada a través de Studio7Salon - '.$_POST['data']['name'];
			$mail->Body    = $mailbody;
            $mail->Send();
        break;
       /**
        *
        * no more options
        * 
        */
        default: exit();                                                
    }
}
?>