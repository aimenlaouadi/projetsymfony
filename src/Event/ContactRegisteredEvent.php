<?php

namespace App\Event;

use App\Entity\Contact;


class ContactRegisteredEvent
{
  public const NAME = 'contact.registered';

  public function __construct(private Contact $contact)
  {
  }

  public function getContact(): Contact
  {
    return $this->contact;
  }
}