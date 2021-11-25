<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
<<<<<<< Updated upstream
=======
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
>>>>>>> Stashed changes

class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_home';

    private UrlGeneratorInterface $urlGenerator;
    private $entityManager;
    private $flashBag;
<<<<<<< Updated upstream

    public function __construct(UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
=======
    private $mailer;

    public function __construct(UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager, FlashBagInterface $flashBag, MailerInterface $mailer)
>>>>>>> Stashed changes
    {
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
<<<<<<< Updated upstream
=======
        $this->mailer = $mailer;
>>>>>>> Stashed changes
    }

    public function authenticate(Request $request): PassportInterface
    {
        $email = $request->request->get('email');
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $email = $request->request->get('email');
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        $user->setNbLoginFailed("0");
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        $this->flashBag->add('login_suc', 'Vous avez été connecté avec succès !');
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
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
                    $this->flashBag->add("log_err", "Votre mot de passe est incorrect, il vous reste " . 3 - $nbError . " essais");
                } else {
                    $this->flashBag->add("log_err", "Votre mot de passe est incorrect, il vous reste " . 3 - $nbError . " essai");
                }
            } else if ($nbError = 2 && $isEnabled == true) {
                $nbError = $nbError + 1;
                $user->setNbLoginFailed($nbError);
                $user->setIsEnabled(false);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
<<<<<<< Updated upstream
=======
                $email = (new TemplatedEmail())
                    ->from("galeriephoto@gaetanlhf.fr")
                    ->to(new Address($user->getEmail()))
                    ->subject("Votre compte a été désactivé de Galerie Photo INSSET")
                    ->htmlTemplate("emails/deactivate.html.twig")
                    ->context([
                        'username' => $user->getUsername()
                    ]);

                $this->mailer->send($email);
>>>>>>> Stashed changes
                $this->flashBag->add("log_err", "Vous avez entré trois fois un mot de passe erroné. Par sécurité, votre compte est désormais désactivé. Veuillez contacter un administrateur pour qu'il vous le réactive.");
            }
        }
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
