<?php

namespace App\Mail;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailContact
{

    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {

    }


    public function sendConfirmation(Contact $contact): void
    {
        $email = (new Email())

        ->from($this->adminEmail)
        ->to($contact->getEmail())
        ->subject('demande de contact')
        ->text('sending email de confirmation');
        

        $this->mailer->send($email);
    }
}