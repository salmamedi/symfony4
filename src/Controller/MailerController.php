<?php

namespace App\Controller;

use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class MailerController extends AbstractController
{
    /**
     * @Route("/mailer", name="mailer")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $name =  'salma';
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('belmaati.falsalma@gmail.com')
            ->setTo('belmaati.falsalma@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;

        die($message);

        $mailer->send($message);

        $this->addFlash('success', 'It sent!');


        return $this->redirect($this->generateUrl('home'));
    }
}
