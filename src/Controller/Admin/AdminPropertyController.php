<?php

namespace  App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;



/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 */
class AdminPropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */
    private $repository;

    /*
    * @var ObjectManager
    */
    // private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em){

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/properties", name ="admin.property.index")
     * @return Response
     */
    public function indexAction()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/index.html.twig', [
            'properties' => $properties

        ]);
    }


    /**
     * @Route("/admin/properties/{id}/edit", name ="admin.property.edit")
     * @return Response
     */
    public function editAction(Request $request, $id)
    {

        $property= $this->repository->find($id);
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $response = new RedirectResponse('admin.property.show');
        }
        $this->em->flush($property);

        return $this->render('admin/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/properties/{id}", name ="admin.property.show")
     * @return Response
     *
     */

    public function showAction($id)
    {
        $property= $this->repository->find($id);
        return $this->render('admin/show.html.twig', [
            'property' => $property
        ]);
    }
}

