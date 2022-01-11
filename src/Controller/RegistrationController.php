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
            $password = $user->genPwd();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $password
            );

            $user->setPassword($hashedPassword);
            $user->setIsEnabled(true);
            $user->setNbLoginFailed("0");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            if ($user->getId() == 1) {
                $user->setRoles(["ROLE_ADMIN"]);
            } else {
                $user->setRoles(["ROLE_USER"]);
            }
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from("gaetan.le.heurt.finot@insset.ovh")
                ->to(new Address($user->getEmail()))
                ->subject("Bienvenue sur Galerie photo INSSET")
                ->htmlTemplate("emails/signup.html.twig")
                ->context([
                    'username' => $user->getUsername(),
                    'password' => $password
                ]);

            $mailer->send($email);

            if ($user->getRoles() == ["ROLE_ADMIN"]) {
                $this->addFlash('register_suc', "Étant le premier utilisateur de cette instance, vous êtes désormais l'administrateur. Votre mot de passe vous été envoyé par courriel.");
            } else {
                $this->addFlash('register_suc', "Vous êtes désormais inscrit ! Votre mot de passe vous été envoyé par courriel.");
            }
        } else {
            $form_errors = array();

            foreach ($registrationForm->getErrors(true) as $error) {
                $form_errors[] = $error->getMessage();
            }

            $this->addFlash('register_err', $form_errors);
        }

        $referer = $request->headers->get('referer');

        if ($referer) {
            return $this->redirect($referer);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }

    public function registerUI(): Response
    {
        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);


        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('partials/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
            'users' => $users
        ]);
    }
}
