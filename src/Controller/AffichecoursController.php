<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Cours;
/**
     * @Route("/affichecours", name="affichecours")
     */
class AffichecoursController extends AbstractController
{
    /**
     * @Route("/{id}", name="affichecours", methods={"GET"})
     */
    public function index(Request $Request,$id):Response
    {
        $repository = $this->getDoctrine()->getRepository(Cours::class);
        $egs = $repository->findBy(
            array('id' => $id, )
            
        );
        return $this->render('affichecours/index.html.twig', [
            'controller_name' => 'AffichecoursController','egs'=>$egs,
        ]);
    }
}
