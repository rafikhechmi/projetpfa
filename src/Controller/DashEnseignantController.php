<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Cours;

class DashEnseignantController extends AbstractController
{
    /**
     * @Route("/dash/enseignant", name="dash_enseignant")
     */
    public function index()
    {
        $session = new Session();
        return $this->render('dash_enseignant/index.html.twig', [
            'id' => $session->getId(),
        ]);
    }

    /**
     * @Route("/dash/enseignant/cour", name="dash_enseignant_cour", methods={"GET"})
     */
    public function findcour(Request $Request):Response
    {
        $session = new Session();
        $id=$session->get('id');
        $repository = $this->getDoctrine()->getRepository(Cours::class);
        $results = $repository->findBy(
            array('enseignant' => $id,)
            
        );
        return $this->render('dash_enseignant/cours.html.twig', [
            'results' => $results,
        ]);
    }
}
