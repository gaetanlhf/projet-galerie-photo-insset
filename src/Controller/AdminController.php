<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAllUsers();
        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/delete', name: 'app_admin_delete_account')]
    public function deleteAccount(Request $request): Response
    {
        $userId = $request->query->get('user');
        $user = $this->getDoctrine()->getRepository(User::class)->findUserById($userId);
        $entityManager = $this->getDoctrine()->getManager();

        if ($user) {
            $entityManager->remove($user[0]);
            $entityManager->flush();
            $this->addFlash('admin_suc', 'Utilisateur supprimé avec succès.');
        } else {
            $this->addFlash('admin_err', 'Impossible de supprimer un utilisateur inexistant !');
        }

        return $this->redirectToRoute('app_admin');

    }

    #[Route('/admin/unblock', name: 'app_admin_unblock_account')]
    public function unblockAccount(Request $request): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
