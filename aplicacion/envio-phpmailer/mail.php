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
    $mail->Username   = 'kristian192019d@gmail.com';                     // SMTP username
    $mail->Password   = 'La bateriaesmejor';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to                                  // TCP port to connect to
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);


        //Recipients
    $mail->setFrom('kristian192019d@gmail.com', 'soporte SGOA');
        $mail->addAddress($correo,$usuario);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Registro a la Plataforma exitoso'; 								//Asunto del mensaje
        $mail->Body    = "<h2>El Sistema de Gestion de Objetos de Aprendizaje SGOA ".$nombre." ".$apellido."</h2> Bienvendido a la Plataforma Digital para el Intercambio de Recursos de Aprendizaje.<br>Tus credenciales son:<br>Usuario: ".$usuario."<br>Contraseña: ".$contraseña;

        $mail->send();
        echo 'Mensaje enviado con exito';
    } catch (Exception $e) {
        echo "Mensaje no pudo ser enviado Error: {$mail->ErrorInfo}"; 
    }

}
?>