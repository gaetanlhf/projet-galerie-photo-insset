<?php

namespace App\EventSubscriber;

use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Mailer\MailerInterface;

class LoginSuccessListener implements EventSubscriberInterface
{
    private $entityManager;
    private $flashBag;

    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'onSymfonyComponentSecurityHttpEventLoginSuccessEvent',
        ];
    }

    public function onSymfonyComponentSecurityHttpEventLoginSuccessEvent(LoginSuccessEvent $event): void
    {
        $request = $event->getRequest();
        $email = $request->request->get('email');
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        $user->setNbLoginFailed("0");
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->flashBag->add('login_suc', 'Vous avez été connecté avec succès !');
    }
}
