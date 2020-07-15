<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(AnnonceRepository $annonceRepository)
    {
        return $this->render('acceuil/index.html.twig', [
            'annonces' => $annonceRepository->findAll()
        ]);
    }
}
