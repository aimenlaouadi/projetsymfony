<?php

namespace App\EventSubscriber;

use App\Entity\Contact;
use App\Event\ContactRegisteredEvent;
use App\Mail\MailContact;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Notifier\Bridge\Discord\DiscordOptions;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordEmbed;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordFieldEmbedObject;
use Symfony\Component\Notifier\Bridge\Discord\Embeds\DiscordMediaEmbedObject;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;


class ContactRegisteredSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private MailContact $mailer,
        private ChatterInterface $chatter,
      ) {
      }

    public function sendConfirmationEmail(ContactRegisteredEvent $event): void
    {
        $contact = $event->getContact();

        $email = $event->getContact();
        $this->mailer->sendConfirmation($email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRegisteredEvent::NAME => [
                ['sendConfirmationEmail', 10],
                ['sendDiscordNotification', 5]
            ],        
        ];
    }

    public function sendDiscordNotification(ContactRegisteredEvent $event): void
        {
            $chatMessage = new ChatMessage('');

            $discordOptions = (new DiscordOptions())
                ->username('connor bot')
                ->addEmbed((new DiscordEmbed())
                ->color(2021216)
                ->title('New song added!')
                ->thumbnail((new DiscordMediaEmbedObject())
                ->url('https://fr.quotes.pics/citation/2505'))
                ->addField((new DiscordFieldEmbedObject())
                ->name('Track')
                ->value('[Common Ground](https://open.spotify.com/track/36TYfGWUhIRlVjM8TxGUK6)')
                ->inline(true)
        )

                 ->addField((new DiscordFieldEmbedObject())
                ->name('lucas')
                ->value('je kiffe les defauts')
                ->inline(true)
        )
        )    
        ;
            $chatMessage->options($discordOptions);
            $this->chatter->send($chatMessage);
        }


}
