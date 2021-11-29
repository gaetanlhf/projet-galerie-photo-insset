<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\User;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAllUserWithPublishedImages();
        $randomUser = null;
        if ($users != null) {
            $randomUser = $this->getDoctrine()->getRepository(User::class)->find($users[mt_rand(0, count($users) - 1)]);
            $randomUserImg = $this->getDoctrine()->getRepository(Image::class)->findImagePublished($randomUser);
            $pager = new Pagerfanta(new QueryAdapter($randomUserImg));
            $pager->setMaxPerPage(12);
            $pager->setCurrentPage(1);
        }

        return $this->render('home/index.html.twig', ['randomUser' => $randomUser, 'randomUserImg' => $pager]);
    }
}
