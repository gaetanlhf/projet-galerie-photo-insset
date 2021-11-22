<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Entity\User;
use App\Form\DeleteImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    #[Route('/u/{username}', name: 'app_usergallery')]
    public function userGallery(string $username): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $img = null;
        if (!$user) {
            $setTitle = 'Galerie photo introuvable';
            $this->addFlash('gallery_err', 'La galerie photo de l\'utilisateur ' . $username . ' n\'a pas été trouvé.');
        } else {
            $setTitle = 'Galerie photo de ' . $username;
            $img = $this->getDoctrine()->getRepository(Image::class)->findImagePublished($user);
            if (!$img) {
                $this->addFlash('gallery_err', 'La galerie photo de l\'utilisateur ' . $username . ' est vide.');
            }
        }
        return $this->render('home/index.html.twig', ['username' => $username, 'setTitle' => $setTitle, 'img' => $img]);
    }

    public function userList()
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

        return $this->render('partials/gallerybar.html.twig', ['users' => $usersData]);
    }
}
