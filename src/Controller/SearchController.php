<?php


namespace App\Controller;


use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 * @package App\Controller
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search_query", methods={"GET"})
     * @param Request $request
     */
    public function query(Request $request)
    {
        # Récupération de la recherche de l'utilisateur
        $searchTerm = $request->query->get("q");

        # Lance la recherche
        $annonces = $this->getDoctrine()
            ->getRepository(Annonce::class)
            ->findBySearchTerm($searchTerm);

        # Affichage des resultats
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonces,
        ]);
    }
}