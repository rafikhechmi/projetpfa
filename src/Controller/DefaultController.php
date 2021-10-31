<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
     * @Route("/", name="default")
     */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('dreamuniversity/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
