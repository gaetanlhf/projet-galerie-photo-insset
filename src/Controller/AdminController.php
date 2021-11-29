<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        $users = $this->getDoctrine()->getRepository(User::class)->findAllUsers();

        $pager = new Pagerfanta(new QueryAdapter($users));
        $pager->setMaxPerPage(12);
        $pager->setCurrentPage($page);
        return $this->render('home/index.html.twig', [
            'users' => $pager,
        ]);
    }

    #[Route('/admin/delete', name: 'app_admin_delete_account')]
    public function deleteAccount(Request $request, MailerInterface $mailer): Response
    {
        $userId = $request->query->get('user');
        $user = $this->getDoctrine()->getRepository(User::class)->findUserById($userId);
        $entityManager = $this->getDoctrine()->getManager();

        if ($user) {
            $entityManager->remove($user[0]);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from("galeriephoto@gaetanlhf.fr")
                ->to(new Address($user[0]->getEmail()))
                ->subject("Supression de votre compte de Galerie photo INSSET")
                ->htmlTemplate("emails/delete.html.twig")
                ->context([
                    'username' => $user[0]->getUsername()
                ]);

                $mailer->send($email);

            $this->addFlash('admin_suc', 'Utilisateur supprimé avec succès.');
        } else {
            $this->addFlash('admin_err', 'Impossible de supprimer un utilisateur inexistant !');
        }

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/admin/reactivate', name: 'app_admin_unblock_account')]
    public function reactivateAccount(Request $request, UserPasswordHasherInterface $passwordHasher,  MailerInterface $mailer): Response
    {
        $userId = $request->query->get('user');
        $user = $this->getDoctrine()->getRepository(User::class)->findUserById($userId);
        $entityManager = $this->getDoctrine()->getManager();

        if ($user) {
            if ($user[0]->getIsEnabled() == false) {
                $user[0]->setIsEnabled(true);
                $user[0]->setNbLoginFailed("0");
                $password = $user[0]->genPwd();
                $hashedPassword = $passwordHasher->hashPassword(
                    $user[0],
                    $password
                );
                $user[0]->setPassword($hashedPassword);
                $entityManager->flush();

                $email = (new TemplatedEmail())
                ->from("galeriephoto@gaetanlhf.fr")
                ->to(new Address($user[0]->getEmail()))
                ->subject("Réactivation de votre compte sur Galerie photo INSSET")
                ->htmlTemplate("emails/reactivate.html.twig")
                ->context([
                    'username' => $user[0]->getUsername(),
                    'password' => $password
                ]);

                $mailer->send($email);

                $this->addFlash('admin_suc', 'Le compte de l\'utilisateur ' . $user[0]->getUsername() . " a bien été réactivé.");
            } else {
                $this->addFlash('admin_err', 'Impossible de réactiver le compte de ' . $user[0]->getUsername() . ', il est déjà activé !');
            }
        } else {
            $this->addFlash('admin_err', 'Impossible de réactiver un compte innexistant !');
        }

        return $this->redirectToRoute('app_admin');
    }
}
