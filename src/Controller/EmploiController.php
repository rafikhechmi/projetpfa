<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\EmploiGroupe;

/**
 * @Route("/emploi")
 */
class EmploiController extends AbstractController
{
    /**
     * @Route("/emploi/{id}", name="emploi", methods={"GET"})
     */
    public function index(Request $Request,$id):Response
    {   
        $repository = $this->getDoctrine()->getRepository(EmploiGroupe::class);
        $egs = $repository->findBy(
            array('groupe' => $id, )
            
        );
        return $this->render('emploi/index.html.twig', [
            'controller_name' => 'EmploiController', 'egs'=>$egs,
        ]);
    }
}
