<?php

namespace App\Controller;

use App\Entity\Filiare;
use App\Form\FiliareType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filiare")
 */
class FiliareController extends AbstractController
{
    /**
     * @Route("/", name="filiare_index", methods={"GET"})
     */
    public function index(): Response
    {
        $filiares = $this->getDoctrine()
            ->getRepository(Filiare::class)
            ->findAll();

        return $this->render('filiare/index.html.twig', [
            'filiares' => $filiares,
        ]);
    }

    /**
     * @Route("/new", name="filiare_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $filiare = new Filiare();
        $form = $this->createForm(FiliareType::class, $filiare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filiare);
            $entityManager->flush();

            return $this->redirectToRoute('filiare_index');
        }

        return $this->render('filiare/new.html.twig', [
            'filiare' => $filiare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filiare_show", methods={"GET"})
     */
    public function show(Filiare $filiare): Response
    {
        return $this->render('filiare/show.html.twig', [
            'filiare' => $filiare,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="filiare_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Filiare $filiare): Response
    {
        $form = $this->createForm(FiliareType::class, $filiare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('filiare_index', [
                'id' => $filiare->getId(),
            ]);
        }

        return $this->render('filiare/edit.html.twig', [
            'filiare' => $filiare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filiare_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Filiare $filiare): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiare->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filiare);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filiare_index');
    }
}
