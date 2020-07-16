<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/{id}", name="message")
     */
    public function index(Annonce $annonce, Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();

            // envoi de mail
            $message = (new \Swift_Message('Nouveau Contact'))
                // On attribue l'expediteur
                ->setFrom($contact['email'])

                // On attribue le destinataire
                ->setTo($annonce->getUser()->getEmail())

                // On crée le message avec la vue Twig
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            
            ;

            // On envoie le message
            $mailer->send($message);

            $this->addFlash('message', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('acceuil');

        }
        return $this->render('message/index.html.twig', [
            'messageForm' => $form->CreateView(),
            'annonce' => $annonce
        ]);
    }
}
