<?php

namespace App\Controller;

use App\Entity\EmploiEnseignant;
use App\Entity\Notification;
use App\Form\EmploiEnseignantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Route("/emploi/enseignant")
 */
class EmploiEnseignantController extends AbstractController
{
    /**
     * @Route("/", name="emploi_enseignant_index", methods={"GET"})
     */
    public function index(): Response
    {
        $emploiEnseignants = $this->getDoctrine()
            ->getRepository(EmploiEnseignant::class)
            ->findAll();

        return $this->render('emploi_enseignant/index.html.twig', [
            'emploi_enseignants' => $emploiEnseignants,
        ]);
    }

    /**
     * @Route("/new", name="emploi_enseignant_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $emploiEnseignant = new EmploiEnseignant();
        $notification=new Notification();
        

        $form = $this->createForm(EmploiEnseignantType::class, $emploiEnseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $emploiEnseignant->getBrochure();
            $fileName = $fileUploader->upload($file);
            $emploiEnseignant->setBrochure($fileName);
            
            $notification->setMessage("neauveau emploi ajouter");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emploiEnseignant);
            $notification->setEnseignant($emploiEnseignant->getEnseignant());
            $entityManager->persist($notification);
            $entityManager->flush();

            return $this->redirectToRoute('emploi_enseignant_index');
        }

        return $this->render('emploi_enseignant/new.html.twig', [
            'emploi_enseignant' => $emploiEnseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emploi_enseignant_show", methods={"GET"})
     */
    public function show(EmploiEnseignant $emploiEnseignant): Response
    {
        return $this->render('emploi_enseignant/show.html.twig', [
            'emploi_enseignant' => $emploiEnseignant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="emploi_enseignant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmploiEnseignant $emploiEnseignant): Response
    {
        $emploiEnseignant->setBrochure(
            new File($this->getParameter('brochures_directory').'/'.$emploiEnseignant->getBrochure())
        );
        $form = $this->createForm(EmploiEnseignantType::class, $emploiEnseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emploi_enseignant_index', [
                'id' => $emploiEnseignant->getId(),
            ]);
        }

        return $this->render('emploi_enseignant/edit.html.twig', [
            'emploi_enseignant' => $emploiEnseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emploi_enseignant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmploiEnseignant $emploiEnseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploiEnseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emploiEnseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emploi_enseignant_index');
    }
}
