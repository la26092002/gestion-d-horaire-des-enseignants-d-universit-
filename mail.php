
<?php
//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = "larbibenyakhou@gmail.com";
//Set gmail password
$mail->Password = "skqtinhqudijaget";
//Email subject
$mail->Subject = "Universite Mustapha Stambouli Mascara";
//Set sender email
$mail->setFrom('larbibenyakhou@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment
$mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = "
    <div class='container'>
        
        <div class='content'>
            <p>Bonjour,</p>
            <p>Nous avons reçu une demande de réinitialisation de votre mot de passe.
              Entrez le mot de passe suivant : </p>
            <p  class='action-button'>$password</p>
            </div>
    </div>
";
//Add recipient
$mail->addAddress($email);
//Finally send email
if ( $mail->send() ) {
    echo "";
}else{
    echo "Message could not be sent. Mailer Error: ";
}
//Closing smtp connection
$mail->smtpClose();
