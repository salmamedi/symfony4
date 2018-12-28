<?php

namespace  App\Controller;


use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;


class PropertyController extends AbstractController {

    /**
    * @var PropertyRepository
    */
     private $repository;
   
    /*
    * @var ObjectManager
    */
   // private $em;

    public function __construct(PropertyRepository $repository){

        $this->repository = $repository;
        //$this->em = $em;
    }

    /**
     * @Route("/biens", name ="property.index")
     * @return Response
     */
    public function index()
    {
        /*$property = new Property();
        $property->setTitle('mon premier titre')
            ->setDescription('mon premier descrription')
            ->setAddress('25 rue saint denis')
            ->setPrice(2000)
            ->setCity('rosny sous bois')
            ->setFloor(5)
            ->setRooms(4)
            ->setSurface(80)
            ->setZipCode(93110)
            ->setHeat(1)
            //->setSold(1)
            ;

            $em = $this->getDoctrine()->getManager();

            $em->persist($property);
            $em->flush();
            $em = $this->getDoctrine()->getManager();

            $Properties = $this->repository->findVisibleProperty();

            /*$updateProperty =  $Properties[0]->setDescription('update description');
              dump($updateProperty); */

            //$em->flush();

        return $this->render('Property/index.html.twig', [
            'current_menu' => 'properties'

        ]);
    }



    /**
     * @Route("/{id}/{slug}", name ="property.show")
     * @return Response
     */
    public function showAction(Property $property, $slug)
    {

        if ($property->getSlug() !== $slug) {
            
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        $em = $this->getDoctrine()->getManager();

        //$property = $this->repository->find($id);
        return $this->render('Property/show.html.twig', [
            'current_menu' => 'properties',
            'property' =>  $property

        ]);
    }
}
