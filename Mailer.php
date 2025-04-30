<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;
    private $to_email;
    private $to_name;
    private $from_email;
    private $from_name;
    private $subject;
    private $message;
    private $is_html = false;

    public function __construct() {
        $config = require __DIR__ . '/config/mailconfig.php';
        
        $this->mail = new PHPMailer(true);
        
        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host = $config['smtp']['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $config['smtp']['username'];
        $this->mail->Password = $config['smtp']['password'];
        $this->mail->SMTPSecure = $config['smtp']['encryption'];
        $this->mail->Port = $config['smtp']['port'];
        
        // Default sender
        $this->from_email = $config['smtp']['from_email'];
        $this->from_name = $config['smtp']['from_name'];
    }
    
    public function setTo($email, $name = '') {
        $this->to_email = $email;
        $this->to_name = $name;
        return $this;
    }
    
    public function setFrom($email, $name = '') {
        $this->from_email = $email;
        $this->from_name = $name;
        return $this;
    }
    
    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }
    
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }
    
    public function setHtml($is_html = true) {
        $this->is_html = $is_html;
        return $this;
    }
    
    public function send() {
        try {
            // Recipients
            $this->mail->setFrom($this->from_email, $this->from_name);
            $this->mail->addAddress($this->to_email, $this->to_name);
            
            // Content
            $this->mail->isHTML($this->is_html);
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->message;
            
            if ($this->is_html) {
                $this->mail->AltBody = strip_tags($this->message);
            }
            
            return $this->mail->send();
        } catch (Exception $e) {
            throw new Exception("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
    
    // Direct method to send email
    public static function sendEmail($to_email, $to_name, $subject, $message) {
        $mailer = new self();
        
        return $mailer->setTo($to_email, $to_name)
               ->setSubject($subject)
               ->setHtml(true)
               ->setMessage($message)
               ->send();
    }
} 