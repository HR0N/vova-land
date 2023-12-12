<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './../../vendor/autoload.php';
//Load Env Class
require './../../env.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

//Create an env exemplar
$env = new EnvLocal();

$mail->CharSet = 'utf-8';

$name = $_POST['form_01_name'];
$email = $_POST['form_01_email'];
$text = $_POST['form_01_text'];

try {
    //Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = false;                                       // debug messages OFF
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $env->get_mailer_mail();                     //SMTP username
    $mail->Password   = $env->get_mailer_pass();                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($env->get_mailer_mail(), 'Company');                // Company name
    $mail->addAddress($env->get_mailer_recipient(), 'Joe User');     //Add a recipient
    $mail->addAddress($env->get_mailer_mail());               //Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC($env->get_mailer_mail(), 'GRANESVIT');

    //Attachment(s)
    //FOR 1
    /*if($_FILES['upload']['tmp_name']){
        $mail->addAttachment($_FILES['upload']['tmp_name'], $_FILES['upload']['name']);    // Optional name
    }*/
    // FOR Multiple
    if (!empty($_FILES['upload']['name'][0])) {
        // Loop through each file
        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
            $tmp_name = $_FILES['upload']['tmp_name'][$i];
            $name = $_FILES['upload']['name'][$i];
            $mail->addAttachment($tmp_name, $name);
        }
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Title name';                        // Title name
    $mail->Body = '<div style="font-family: Arial, sans-serif; color: #444444; background-color: #f4f4f4; padding: 20px;">
                    <h1 style="color: #444;">Нове повідомлення від компанії</h1>
                    <div style="background-color: #ffffff; padding: 10px; border-radius: 10px; margin-top: 20px; max-width: 500px;">
                        <p style="font-size: 18px;"><strong>Ім\'я:</strong> ' . $name . '</p>
                        <p style="font-size: 18px;"><strong>Пошта:</strong> ' . $email . '</p>
                        <p style="font-size: 18px;"><strong>Повідомлення:</strong> ' . $text . '</p>
                    </div>
                  </div>';

    $mail->AltBody = '';

    $mail->send();
//    echo 'Message has been sent';
    header('location: /');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}