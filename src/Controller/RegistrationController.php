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
    #[Route('/register', name: 'app_register')]
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

            $user->setPassword($hashedPassword);
<<<<<<< Updated upstream
            $user->setRoles(["ROLE_USER"]);
=======
>>>>>>> Stashed changes
            $user->setIsEnabled(true);
            $user->setNbLoginFailed("0");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

<<<<<<< Updated upstream
            $email = (new TemplatedEmail())
                ->from("noreply@dev.gaetanlhf.fr")
                ->to(new Address($user->getEmail()))
                ->subject("Votre mot de passe pour Galerie Photo")
=======
            if ($user->getId() == 1) {
                $user->setRoles(["ROLE_ADMIN"]);
            } else {
                $user->setRoles(["ROLE_USER"]);
            }
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from("galeriephoto@gaetanlhf.fr")
                ->to(new Address($user->getEmail()))
                ->subject("Bienvenue sur Galerie Photo INSSET")
>>>>>>> Stashed changes
                ->htmlTemplate("emails/signup.html.twig")
                ->context([
                    'username' => $user->getUsername(),
                    'password' => $password
                ]);

<<<<<<< Updated upstream
            // $mailer->send($email);

            $this->addFlash('register_suc', $password);
=======
            $mailer->send($email);
            
            if ($user->getRoles() == ["ROLE_ADMIN"]) {
                $this->addFlash('register_suc', "Étant le premier utilisateur de cette instance, vous êtes désormais l'administrateur. Votre mot de passe vous été envoyé par courriel : " . $password);
            } else {
                $this->addFlash('register_suc', "Vous êtes désormais inscrit ! Votre mot de passe vous été envoyé par courriel : " . $password);
            }
>>>>>>> Stashed changes

            return $this->redirectToRoute('app_home');
        }

        $form_errors = array();

        foreach ($registrationForm->getErrors(true) as $error) {
            $form_errors[] = $error->getMessage();
        }

        $this->addFlash('register_err', $form_errors);
        
        return $this->redirectToRoute('app_home');
    }

    public function genPwd(): String
    {
        $length = "8";
        $character = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = "";
        $max = mb_strlen($character, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $string .= $character[random_int(0, $max)];
        }
        return $string;
    }
}
