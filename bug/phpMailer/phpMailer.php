<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

Class UsedPhpMailer 
{
  public readonly PHPMailer $mail;
  public readonly Exception $exception;

  public function __construct()
  {
    $this->mail = New PHPMailer(true);
    $this->exception = New Exception;

    $this->mail->isSMTP();
    $this->mail->SMTPAuth = true;

    $this->mail->Host = "smtp.gmail.com";
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $this->mail->Port = 587;
    $this->mail->Username = "xisto3771@gmail.com";
    $this->mail->Password = "hrdc kivg ypmx vtsk";

    $this->mail->isHtml(true);
  }

  public function sendMail($data){

    $this->mail->setFrom("xistopet@gmail.com");
    $this->mail->addAddress($data['email']);
    $this->mail->Subject = $data['subject'];
    $this->mail->Body = $data['message'];
    
    try {

        $this->mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$this->mail->ErrorInfo}";

    }


  }
}