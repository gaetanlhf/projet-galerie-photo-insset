<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegistrationUIController extends AbstractController
{
    public function registerUI(): Response
    {
        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('partials/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }
}
