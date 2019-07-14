<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

function enviarCorreo($correo,$usuario,$contraseña,$nombre,$apellido){

    //note que este tipo de procedimiento se hace solo cuando se envia un correo desde el localhost
    //Instanciacion de las variables para el envio de correo
    $mail = new PHPMailer(true);

    try {
//Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers  
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'plataformadigital.ira@gmail.com';                     // SMTP username
    $mail->Password   = 'pdira1234';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to                                  // TCP port to connect to

        //Recipients
    $mail->setFrom('plataformadigital.ira@gmail.com', 'Plataforma Digital para el Intercambio de Recursos de Aprendizaje');
        $mail->addAddress($correo,$usuario);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Registro a la Plataforma exitoso'; 								//Asunto del mensaje
        $mail->Body    = "<h2>HOLA ".$nombre." ".$apellido."</h2> Bienvendido a la Plataforma Digital para el Intercambio de Recursos de Aprendizaje.<br>Tus credenciales son:<br>Usuario: ".$usuario."<br>Contraseña: ".$contraseña;

        $mail->send();
        echo 'Mensaje enviado con exito';
    } catch (Exception $e) {
        echo "Mensaje no pudo ser enviado Error: {$mail->ErrorInfo}";
    }

}
?>