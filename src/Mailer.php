<?php

namespace Grimlock;

use Grimlock\Exception\GrimlockException;
use Grimlock\Mail\MailPerson;
use Grimlock\Util\ArrayList;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{

    private $mail;
    private $senderMail;
    private $senderName;

    public function __construct($config = './resources/grimlock.mail.config.php') {
        $this->validateConfig($config);
        include $config;
        $this->mail = new PHPMailer();
        $this->mail->CharSet = "utf-8";
        $this->mail->IsSMTP();
        $this->mail->SMTPAuth = $grimlock_mail_auth;
        if($grimlock_mail_debug)
            $this->mail->SMTPDebug = 2;
        $this->mail->Host = $grimlock_mail_host;
        $this->mail->Username = $grimlock_mail_email;
        $this->mail->Password = $grimlock_mail_password;
        $this->mail->SMTPSecure = $grimlock_mail_secure;
        $this->mail->SMTPAutoTLS = $grimlock_mail_tls;
        $this->mail->Port = $grimlock_mail_port;

        $this->mail->IsHTML(true);
    }
    
    private function validateConfig($config) {
        if (is_readable($config)) {
            include $config;
            if (empty($grimlock_mail_host)) {
                throw new GrimlockException(Mailer::class, 'Grimlock Mail Host is not set.');
            } else if (empty($grimlock_mail_email)) {
                throw new GrimlockException(Mailer::class, 'Grimlock Mail Email is not set.');
            } else if (empty($grimlock_mail_password)) {
                throw new GrimlockException(Mailer::class, 'Grimlock Mail Password is not set.');
            }
        } else {
            throw new GrimlockException(Mailer::class, 'Config file not exist.');
        }
        
    }

    public function generateMail(MailPerson $address, $subject, $body, ArrayList $lAddressCc = null, ArrayList $lAddressBcc = null, ArrayList $lAttachments = null){
        $this->mail->From = $this->senderMail;
        $this->mail->FromName = $this->senderName;
        $this->mail->AddAddress($address->getMail(), $address->getName());

        if($lAddressCc != null){
            for ($i = 0; $i < $lAddressCc->getSize(); $i++){
                $ccAddress = $lAddressCc->getItem($i);
                $this->mail->addCC($ccAddress->getMail(), $ccAddress->getName());
            }
        }
        if($lAddressBcc != null){
            for ($i = 0; $i < $lAddressBcc->getSize(); $i++){
                $bccAddress = $lAddressBcc->getItem($i);
                $this->mail->addBCC($bccAddress->getMail(), $bccAddress->getName());
            }
        }

        if($lAttachments != null){
            for($i = 0; $i < $lAttachments->getSize(); $i++){
                $bAttachment = $lAttachments->getItem($i);
                $attachment = base64_decode($bAttachment->getBase64());
                $this->mail->addStringAttachment($attachment, $bAttachment->getName(), "base64", $bAttachment->getType());
            }
        }

        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
    }

    public function generateHtml($html, ArrayList $lParameters = null){
        if($lParameters != null){
            for($i = 0; $i < $lParameters->getSize(); $i++){
                $parameter = $lParameters->getItem($i);
                $html = str_replace($parameter->getName(), $parameter->getValue(), $html);
            }
        }

        $this->mail->Body = $html;
    }

    public function sendMail(){
        $res = $this->mail->Send();
        if($res > 0){
            return true;
        }
        else {
            return false;
        }
    }

}