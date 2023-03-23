<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

function send_email($email){

//PHP Mailer
    require './vendor/autoload.php';

// Instanziare
    $phpmailer = new PHPMailer(true);

    try {
        //Server settings
        $phpmailer->isSMTP();                                            
        $phpmailer->Host       = 'sandbox.smtp.mailtrap.io';                    
        $phpmailer->SMTPAuth   = true;                                   
        $phpmailer->Username   = 'bdc108523992d7';               
        $phpmailer->Password   = '5da9981d08ca6f';               
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
        $phpmailer->Port       = 2525;

        //Genera random token per il password reset link
        $reset_token = bin2hex(random_bytes(32));

        //Recipients
        $phpmailer->setFrom('email@edusogno.com', 'Edusogno');
        $phpmailer->addAddress($email);                           

        //Content
        $phpmailer->isHTML(true);                                  
        $phpmailer->Subject = 'Richiesta reset password';
        $phpmailer->Body    = 'Ciao,'."<br><br>".'Entra in questo link per resettare la tua password:'."<br><br>".'<a href="http://localhost/edusogno-esercizio%20-%20Copia/passwordreset.php?token='.$reset_token.'">Resetta Password</a>'."<br><br>".'Grazie,'."<br>".'Edusogno';

        $phpmailer->send();
        echo '<h4>Controlla la tua casella email, ti abbiamo mandato un link per resettarla</h4>';
    } catch (Exception $e) {
        echo "Errore nell'invio del link per resettare la password: {$phpmailer->ErrorInfo}";
    }
}