<?php
    $mail = new PHPMailer;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.palcards.000free.us';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'admin@palcards.000free.us';                 // SMTP username
    $mail->Password = '1412dk';                           // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to
    $mail->setFrom('admin@parkir.tk', 'Admin PT. PAL');
?>
