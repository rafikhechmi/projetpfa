<?php

namespace App\Controller;

use App\Entity\EmploiGroupe;
use App\Form\EmploiGroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Route("/emploi/groupe")
 */
class EmploiGroupeController extends AbstractController
{
    /**
     * @Route("/", name="emploi_groupe_index", methods={"GET"})
     */
    public function index(): Response
    {
        $emploiGroupes = $this->getDoctrine()
            ->getRepository(EmploiGroupe::class)
            ->findAll();

        return $this->render('emploi_groupe/index.html.twig', [
            'emploi_groupes' => $emploiGroupes,
        ]);
    }

    /**
     * @Route("/new", name="emploi_groupe_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $emploiGroupe = new EmploiGroupe();
        $form = $this->createForm(EmploiGroupeType::class, $emploiGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $emploiGroupe->getBrochure();
            $fileName = $fileUploader->upload($file);
            $emploiGroupe->setBrochure($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emploiGroupe);
            $entityManager->flush();

            return $this->redirectToRoute('emploi_groupe_index');
        }

        return $this->render('emploi_groupe/new.html.twig', [
            'emploi_groupe' => $emploiGroupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emploi_groupe_show", methods={"GET"})
     */
    public function show(EmploiGroupe $emploiGroupe): Response
    {
        return $this->render('emploi_groupe/show.html.twig', [
            'emploi_groupe' => $emploiGroupe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="emploi_groupe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmploiGroupe $emploiGroupe): Response
    {
        $emploiGroupe->setBrochure(
            new File($this->getParameter('brochures_directory').'/'.$emploiGroupe->getBrochure())
        );
        $form = $this->createForm(EmploiGroupeType::class, $emploiGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emploi_groupe_index', [
                'id' => $emploiGroupe->getId(),
            ]);
        }

        return $this->render('emploi_groupe/edit.html.twig', [
            'emploi_groupe' => $emploiGroupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emploi_groupe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmploiGroupe $emploiGroupe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploiGroupe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emploiGroupe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emploi_groupe_index');
    }
}
