<?php

namespace  App\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;


class  HomeController extends AbstractController {

	/**
    * @var PropertyRepository
    */
     private $repository;
    
    public function __construct(PropertyRepository $repository){

        $this->repository = $repository;
    }



    /**
     * Class HomeController
     * @package App\Controller
     * @route("/", name="home")
     */
    public  function index()
    {
    	$em = $this->getDoctrine()->getManager();
        //$properties = $this->repository->findAll();
        $properties = $this->repository->findLAtest();

        return $this->render('Pages/home.html.twig', array(
        	'properties' => $properties
        ));

    }

}
