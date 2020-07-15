<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
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
                ->setTo('getEmail')

                // On crée le message avec la vue Twig
                ->setBody(
                    $this->renderView(
                        'emails/message.html.twig', compact('message')
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
            'messageForm' => $form->CreateView()
        ]);
    }
}
