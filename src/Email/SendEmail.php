<?php

namespace App\Email;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;


class SendEmail
{
    /**
     * @var EntityManager $entityManager
     */
    private $em;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $templating;


    public function __construct(EntityManagerInterface $em, \Swift_Mailer $mailer, $templating, $from)
    {
        $this->em               = $em;
        $this->mailer           = $mailer;
        $this->templating       = $templating;
        $this->from             = $from;
    }

    public function send($email, $subject, $template, $attachment = false)
    {
        if (!$email) {
            return;
        }

        $template = $template.'html.twig';

        $message = \Swift_Message::newInstance()
            ->setSubject('[Science Accueil] '.$subject)
            ->setFrom($this->from)
            ->setTo([$email])
            ->setContentType("text/html")
            ->setBody(
                $this->templating->render('AppBundle:Mailer:'.$template),
                'text/html'
            );

        if ($attachment) {
            $message->attach(
                \Swift_Attachment::newInstance($attachment['content'])
                    ->setFilename($attachment['filename'])
                    ->setContentType($attachment['mimetype'])
            );
        }

        $this->mailer->send($message);
    }
    
}