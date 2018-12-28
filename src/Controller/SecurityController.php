<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class SecurityController extends AbstractController
{
//    /**
//     * @Route("/security", name="security")
//     */
//    public function index()
//    {
//        return $this->render('security/index.html.twig', [
//            'controller_name' => 'SecurityController',
//        ]);
//    }

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
        
    }

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder){
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()){
             $password = $encoder->encodePassword($user, $user->getPassword());
             $user->setPassword($password);
             $this->em->persist($user);
             $this->em->flush();

             return $this->redirectToRoute('property.index');
         }
        return $this->render('security/registration.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request){
        
        
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('property.index');
        }
        return $this->render('security/registration.html.twig', array(
            'form' => $form->createView()
        ));

    }
    
}
