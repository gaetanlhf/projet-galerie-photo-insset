<?php

namespace App\EventListener;
 
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
 
class LogoutListener
{
    private $flashBag;
 
    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    public function __invoke()
    {
        $this->flashBag->add('logout_suc', 'Vous avez été déconnecté avec succès !');
    }
}