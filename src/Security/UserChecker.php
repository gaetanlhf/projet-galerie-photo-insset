<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class UserChecker implements UserCheckerInterface
{
    private $flashBag;

    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->getIsEnabled()) {
            $this->flashBag->add("log_err", "Votre compte est désactivé. Veuillez contacter un administrateur pour qu'il vous le réactive.");
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }
    }
}
