<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email {

    public $email;
    public $nombre;
    public $token;

    // Constructor -----
    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    // Enviar email de confirmacion
    public function enviarConfirmacion() {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer();
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'c063a580467510';                     //SMTP username
        $mail->Password   = 'ed13328d842805';                               //SMTP password
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');     
        $mail->Subject = 'Confirma tu cuenta';

        // HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $this->nombre ."</strong>. Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirma tu Email</a> </p>";
        $contenido.= "<p>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email 
        $mail->send();
    }   

    // Enviar instrucciones de reseteo de contraseña
    public function enviarInstrucciones(){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer();
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'c063a580467510';                     //SMTP username
        $mail->Password   = 'ed13328d842805';                               //SMTP password
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');     
        $mail->Subject = 'Reestablece tu password';

        // HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $this->nombre ."</strong>. Has solicitado reestablecer tu password. Sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=".$this->token."'>Reestablecer Password</a> </p>";
        $contenido.= "<p>Si tú no solicitaste esta cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email 
        $mail->send();
    }
}