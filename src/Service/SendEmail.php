<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class SendEmail{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailInterface=$mailer;
    }
    public function email($data, $subject = "creationCompte")
    {
        $alou = (new Email())
              ->from("alou0706@gmail.com")
              ->to($data->getEmail())
              ->subject($subject)
              ->html("Bonjour")    
        ;     
        $this->mailInterface->send($alou);   
      
    }
    
}