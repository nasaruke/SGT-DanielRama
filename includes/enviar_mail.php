<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require "verificarcuenta.php";

function envmail($nombre, $mai, $tok){
//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'juab12300147@gmail.com';                     //SMTP username
        $mail->Password   = 'bzheqgpfhoxxdbys'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('juab12300147@gmail.com', 'Admin');
        $mail->addAddress($mai, $nombre);     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $nombre;
        $mail->Body    = "<p> Presiona aqui: <a href='http://192.168.115.85/RegistroExitoso.php?token=".$tok."'> Confirmar Cuenta </p>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}