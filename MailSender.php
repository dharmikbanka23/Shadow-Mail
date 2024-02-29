<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class MailSender
{
  public static function sendEmail($to, $subject, $body)
  {
    try {
      // Initialize PHPMailer
      $mail = new PHPMailer(true);

      // Server settings for Gmail
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = getenv('EMAIL'); // Your Gmail email address
      $mail->Password = getenv('PASSWORD'); // Your Gmail email password
      $mail->SMTPSecure = 'tls'; // Use TLS encryption
      $mail->Port = 587;

      // Sender (you can customize this)
      $mail->setFrom(getenv('EMAIL'), $_COOKIE['name']);

      // Recipient
      $mail->addAddress($to);

      // Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;

      // Send the email
      $mail->send();
      return true; // Email sent successfully
    }
    catch (Exception $e) {
      return false; // Error sending email
    }
  }
}