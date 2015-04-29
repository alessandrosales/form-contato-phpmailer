<?php

require 'vendor/autoload.php';

$informacoes = (object)$_POST;

$subject = "Email de {$informacoes->nome}";
$body = "Informações <br><br>Nome: {$informacoes->nome} <br>Email: {$informacoes->email} <br><br>Mensagem: {$informacoes->mensagem}";

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.exemplo.com;';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'username@exemplo.com';             // SMTP username
$mail->Password = 'senha';                            // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'email.de.envio@exemplo.com';
$mail->FromName = 'Nome remetente';
$mail->addAddress('email.de.recebimento@exemplo.com', 'Nome destinatário');     // Add a recipient
$mail->addReplyTo('email.de.resposta');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = strip_tags($body);

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}