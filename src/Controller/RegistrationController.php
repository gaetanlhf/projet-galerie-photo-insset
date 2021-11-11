<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer): Response
    {
        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

            $user = $registrationForm->getData();
            $password = $this->genPwd();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $password
            );

            // encode the plain password
            $user->setPassword($hashedPassword);
            $user->setRoles(["USER"]);
            $user->setIsEnabled(true);
            $user->setNbLoginFailed("0");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $email = (new TemplatedEmail())
                ->from("noreply@gaetan-le-heurt-finot.insset.ovh", "Gallerie photo")
                ->to(new Address($user['email']))
                ->subject("Votre mot de passe pour Galerie Photo")
                ->htmlTemplate("emails/signup.html.twig")
                ->context([
                    'username' => $user['username'],
                    'password' => $password
                ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_home', array('success' => true));
        }

        $form_errors = array();

        //this part get global form errors (like csrf token error)
        foreach ($registrationForm->getErrors(true) as $error) {
            $form_errors[] = $error->getMessage();
        }


        // dd($form_errors);
        $this->addFlash('register_err', $form_errors);
        return $this->redirectToRoute('app_home');
    }

    public function genPwd(): String
    {
        $length = "10";
        $character = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = "";
        $max = mb_strlen($character, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $string .= $character[random_int(0, $max)];
        }
        return $string;
    }
}
