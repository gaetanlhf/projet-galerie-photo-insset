<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyGalleryController extends AbstractController
{
    #[Route('/mygallery', name: 'app_mygallery')]
    public function myGallery(): Response
    {
        $setTitle = 'Ma galerie photo';
        $user = $this->getUser();
        $img = $this->getDoctrine()->getRepository(Image::class)->findAllImage($user);
        $countImg = $this->getDoctrine()->getRepository(Image::class)->countImage($user);

        $image = new Image();
        $uploadForm = $this->createForm(ImageType::class, $image);

        return $this->render('home/index.html.twig', ['uploadForm' => $uploadForm->createView(), 'setTitle' => $setTitle, 'img' => $img, 'countImg' => $countImg]);
    }

    #[Route('/mygallery/upload', name: 'app_mygallery_upload')]
    public function myGalleryUpload(Request $request): Response
    {
        $user = $this->getUser();

        $image = new Image();
        $uploadForm = $this->createform(ImageType::class, $image);
        $uploadForm->handleRequest($request);

        if ($uploadForm->isSubmitted() && $uploadForm->isValid()) {

            $uploadedFile = $uploadForm->get('image')->getData();

            $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move($this->getParameter('img_path'), $newFilename);

            $image->setUser($user);
            $image->setfileLocalisation($newFilename);
            $image->setSize(filesize($uploadedFile));
            $image->setDate(new \DateTime('@' . strtotime('now')));
            $image->setPosition("0");

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            $user->addImage($image);

            $this->addFlash('gallery_suc', 'Image ajoutée avec succès.');

            return $this->redirect($this->generateUrl('app_mygallery'));
        } else {
            $this->addFlash('gallery_err', 'Une erreur est survenue lors du téléversement de l\'image.');
            return $this->redirectToRoute('app_mygallery');
        }
    }

    #[Route('/mygallery/changepos', name: 'app_mygallery_changepos')]
    public function myGalleryChangePos(Request $request): Response
    {
        $image = $request->query->get('image');
        $position = $request->query->get('position');
        $user = $this->getUser();
        if (isset($image) && isset($position)) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $entityManager->getRepository(Image::class)->findBy(['user' => $user, 'id' => $image]);
            if ($image) {
                if ($position == $image[0]->getPosition()) {
                    $this->addFlash('gallery_err', 'L\'image est déjà sur cette position.');
                    return $this->redirectToRoute('app_mygallery');
                } else if ($position != 0 && $entityManager->getRepository(Image::class)->findBy(['user' => $user, 'position' => $position])) {
                    $userImgs = $entityManager->getRepository(Image::class)->findBy(['user' => $user]);
                    foreach ($userImgs as $img) {
                        if ($img->getPosition() >= $position) {
                            $oldPos = $img->getPosition();
                            $newPos = $oldPos + 1;
                            if ($newPos > $entityManager->getRepository(Image::class)->countImage(['user' => $user])) {
                                $newPos = $image[0]->getPosition();
                                $img->setPosition($newPos);
                                $entityManager->flush();
                            } else {
                                $img->setPosition($newPos);
                                $entityManager->flush();
                            }
                        }
                    }
                    $image[0]->setPosition($position);
                    $entityManager->flush();
                    $this->addFlash('gallery_suc', 'L\'image a bien été placée en position ' . $position . ' avec succès !');
                } else {
                    if ($position == 0) {
                        $userImgs = $entityManager->getRepository(Image::class)->findBy(['user' => $user]);
                        foreach ($userImgs as $img) {
                            if ($img->getPosition() != $position && $img->getPosition() > $image[0]->getPosition()) {
                                $oldPos = $img->getPosition();
                                $newPos = $oldPos - 1;

                                $img->setPosition($newPos);
                                $entityManager->flush();
                            }
                        }
                        $this->addFlash('gallery_suc', 'L\'image a bien été dépubliée avec succès !');
                    } else {
                        $this->addFlash('gallery_suc', 'L\'image a bien été placée en position ' . $position . ' avec succès !');
                    }
                    $image[0]->setPosition($position);
                    $entityManager->flush();
                }
            }
            return $this->redirectToRoute('app_mygallery');
        } else {
            $this->addFlash('gallery_err', 'Impossible de modifier la position d\'une image inexistante.');
            return $this->redirectToRoute('app_mygallery');
        }
    }

    #[Route('/mygallery/delete', name: 'app_mygallery_delete')]
    public function myGalleryDelete(Request $request): Response
    {
        $image = $request->query->get('image');
        $user = $this->getUser();
        if ($image) {
            $entityManager = $this->getDoctrine()->getManager();

            $image = $entityManager->getRepository(Image::class)->findBy(['user' => $user, 'id' => $image]);

            if ($image) {
                $imgPos = $image[0]->getPosition();
                if ($imgPos != 0) {
                    $userImgs = $entityManager->getRepository(Image::class)->findBy(['user' => $user]);
                    foreach ($userImgs as $img) {
                        if ($img->getPosition() != 0 && $img->getPosition() > $image[0]->getPosition()) {
                            $oldPos = $img->getPosition();
                            $newPos = $oldPos - 1;

                            $img->setPosition($newPos);
                            $entityManager->flush();
                        }
                    }
                }
                $entityManager->remove($image[0]);
                $entityManager->flush();
                $this->addFlash('gallery_suc', 'Image supprimée avec succès.');
            }
            return $this->redirectToRoute('app_mygallery');
        } else {
            $this->addFlash('gallery_err', 'Impossible de supprimer une image inexistante.');
            return $this->redirectToRoute('app_mygallery');
        }
    }
}
