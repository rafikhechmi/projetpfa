<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Admin;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
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
            return $this->render('admin.html.twig');
             
        }
            else{$mess="fail";}
        return $this->render('login/index.html.twig', [
            'mess' => $admin,
        ]);
        }
        

        return $this->render('login/index.html.twig', [
            'mess' => $mess,
        ]);
    }
}
