<?php

namespace App\EventSubscriber;

use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class LoginFailureListener implements EventSubscriberInterface
{
    private $entityManager;
    private $flashBag;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginFailureEvent::class => 'onSymfonyComponentSecurityHttpEventLoginFailureEvent',
        ];
    }

    public function onSymfonyComponentSecurityHttpEventLoginFailureEvent(LoginFailureEvent $event): void
    {
        $request = $event->getRequest();
        $email = $request->request->get('email');
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if (!$user) {
            $this->flashBag->add("log_err", "La connexion a échoué, aucun compte n'a été trouvé.");
        } else {
            $nbError = $user->getNbLoginFailed();
            $isEnabled = $user->getIsEnabled();
            if ($nbError < 2) {
                $nbError = $nbError + 1;
                $user->setNbLoginFailed($nbError);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                if (3 - $nbError != 1) {
                    $this->flashBag->add("log_err", "Votre mot de passe est incorrect, il vous reste " . 3 - $nbError . " essais avant que votre compte soit désactivé par sécurité.");
                } else {
                    $this->flashBag->add("log_err", "Votre mot de passe est incorrect, il vous reste " . 3 - $nbError . " essai avant que votre compte soit désactivé par sécurité.");
                }
            } else if ($nbError = 2 && $isEnabled == true) {
                $user->setNbLoginFailed("3");
                $user->setIsEnabled(false);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $email = (new TemplatedEmail())
                    ->from("gaetan.le.heurt.finot@insset.ovh")
                    ->to(new Address($user->getEmail()))
                    ->subject("Votre compte a été désactivé de Galerie photo INSSET")
                    ->htmlTemplate("emails/deactivate.html.twig")
                    ->context([
                        'username' => $user->getUsername()
                    ]);

                $this->mailer->send($email);
                $this->flashBag->add("log_err", "Vous avez entré trois fois un mot de passe erroné. Par sécurité, votre compte est désormais désactivé. Veuillez contacter un administrateur pour qu'il vous le réactive.");
            }
        }
    }
}
