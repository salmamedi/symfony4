<?php

namespace  App\Controller;

use App\Entity\Property;
//use GuzzleHttp\Psr7\Request;
use App\Entity\Search;
use App\Form\SearchType;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use  Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

//use Symfony\Component\Validator\Constraints\DateTime;



class PropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(PropertyRepository $repository, PaginatorInterface $paginator ){

        $this->repository = $repository;
        $this->paginator = $paginator;
    }


    /**
     * @Route("/biens", name ="property.index")
     * @return Response
     */
    public function index(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
       // die(var_dump($form->getData()));
//        if($form->isSubmitted() && $form->isValid()){
//            //$data = $form->getData();
//           // die(var_dump( $data));
//        }

        $query = $this->repository->findAllVisbileQuery($search);
        $pagination =  $this->paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        
        return $this->render('Property/index.html.twig', [
            'current_menu' => 'properties',
             'pagination' => $pagination,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/{slug}/{id}", name ="property.show")
     * @return Response
     */
    public function showAction($slug, $id)
    {
        $property = $this->repository->find($id);

       // die($property->getSlug());
//        if ($property->getSlug() !== $slug) {
//            return $this->redirectToRoute('property.show',[
//               'id' => $property->getId(),
//                'slug' => $property->getSlug()
//            ]);
//        }

        return $this->render('Property/show.html.twig', [
            'current_menu' => 'properties',
            'property' =>  $property
        ]);
    }

    /**
     * @Route("/active", name="property.active")
     */
    public function propertyActive()
    {
        $propertiesActive = $this->repository->findActive(new DateTime('-30 days'));

        return $this->render('Property/active.html.twig', [
           'propertiesActive' => $propertiesActive
        ]);
    }
}
