<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Categorie;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonce")
 */
class AnnonceController extends AbstractController
{
    /**
     * @Route("/", name="annonce_index", methods={"GET"})
     */
    public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    /**
     * Afficher les annonces par catégorie
     * @Route("/categorie/{id}", name="annonce_categorie", methods={"GET"})
     * @param Categorie $categorie
     * @return Response
     */
    public function categorie(Categorie $categorie)
    {
        # Récupération des annonces de la categorie
        $annonces = $categorie->getAnnonces();

        # Transmission a la vue.
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    /**
     * @Route("/new", name="annonce_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonce_index');
        }

        return $this->render('annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonce_show", methods={"GET"})
     */
    public function show(Annonce $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annonce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annonce $annonce): Response
    {
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_index');
        }

        return $this->render('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Annonce $annonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonce_index');
    }
}
