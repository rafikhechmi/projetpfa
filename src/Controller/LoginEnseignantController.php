<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Enseignant;
use App\Entity\Admin;
use Symfony\Component\HttpFoundation\Session\Session;



class LoginEnseignantController extends AbstractController
{
    /**
     * @Route("/login/enseignant", name="login_enseignant")
     */
    public function index(Request $Request):Response
    {   
        $username="";
        $password="";
        $mess="";
        
        if ($Request->getMethod() == Request::METHOD_POST){
        $username = $Request->request->get('username');
        $password = $Request->request->get('password');
        
        $repository = $this->getDoctrine()->getRepository(Admin::class);
        $admin = $repository->findOneBy(
            array('login' => $username, 'pdw' => $password)
            
        );
        if($admin != null){
            $session = new Session();
           
            $session->set('id', $admin->getId());
            return $this->render('dash_enseignant/index.html.twig',['id' => $session->get('id'),]);
             
        }
            else{$mess="fail";}
        return $this->render('login_enseignant/index.html.twig', [
            'mess' => $admin, 
        ]);
        }
        

        return $this->render('login_enseignant/index.html.twig', [
            'mess' => $mess,
        ]);
    }
   
}
