<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\User;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAllUserWithPublishedImages();
        $randomUser = null;
        $pager = null;
        if ($users != null) {
            $randomUser = $this->getDoctrine()->getRepository(User::class)->find($users[mt_rand(0, count($users) - 1)]);
            $randomUserImg = $this->getDoctrine()->getRepository(Image::class)->findImagePublished($randomUser);
            $pager = new Pagerfanta(new QueryAdapter($randomUserImg));
            $pager->setMaxPerPage(12);
            $pager->setCurrentPage(1);
        }

        return $this->render('index.html.twig', ['randomUser' => $randomUser, 'randomUserImg' => $pager]);
    }

    #[Route('/u/{username}', name: 'app_usergallery')]
    public function userGallery(Request $request, string $username): Response
    {
        $page = $request->query->get('page', 1);
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $pager = null;
        if (!$user) {
            $setTitle = 'Galerie photo introuvable';
            $this->addFlash('gallery_err', 'La galerie photo de l\'utilisateur ' . $username . ' n\'a pas été trouvé.');
        } else {
            $setTitle = 'Galerie photo de ' . $username;
            $img = $this->getDoctrine()->getRepository(Image::class)->findImagePublished($user);
            $pager = new Pagerfanta(new QueryAdapter($img));
            $pager->setMaxPerPage(12);
            $pager->setCurrentPage($page);
            if ($pager->getNbResults() == 0) {
                $this->addFlash('gallery_err', 'La galerie photo de l\'utilisateur ' . $username . ' est vide.');
            }
        }
        return $this->render('index.html.twig', ['username' => $username, 'setTitle' => $setTitle, 'images' => $pager]);
    }

    public function userList(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAllUserWithPublishedImages();
        if ($users != null) {
            $usersData = array();
            foreach ($users as $user) {
                array_push($usersData, $this->getDoctrine()->getRepository(User::class)->find($user));
            }
        } else {
            $usersData = null;
        }

        return $this->render('partials/gallerylist.html.twig', ['users' => $usersData]);
    }
}
