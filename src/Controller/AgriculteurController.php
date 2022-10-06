<?php

namespace App\Controller;

use App\Entity\Agriculteur;
use App\Form\AgriculteurType;
use App\Repository\AgriculteurRepository;
use App\Repository\TypeProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class AgriculteurController extends AbstractController
{
    /**
     * @Route("/", name="app_agriculteur_index", methods={"GET"})
     */
    public function index(AgriculteurRepository $agriculteurRepository, TypeProduitRepository $typeProduitRepository): Response
    {
        return $this->render('agriculteur/index.html.twig', [
            'agriculteurs' => $agriculteurRepository->findAll(),
            'typeProduits' => $typeProduitRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="app_agriculteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AgriculteurRepository $agriculteurRepository): Response
    {
        $agriculteur = new Agriculteur();
        $form = $this->createForm(AgriculteurType::class, $agriculteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agriculteurRepository->add($agriculteur, true);

            return $this->redirectToRoute('app_agriculteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agriculteur/new.html.twig', [
            'agriculteur' => $agriculteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_agriculteur_show", methods={"GET"})
     */
    public function show(Agriculteur $agriculteur): Response
    {
        return $this->render('agriculteur/show.html.twig', [
            'agriculteur' => $agriculteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_agriculteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Agriculteur $agriculteur, AgriculteurRepository $agriculteurRepository): Response
    {
        $form = $this->createForm(AgriculteurType::class, $agriculteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agriculteurRepository->add($agriculteur, true);

            return $this->redirectToRoute('app_agriculteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agriculteur/edit.html.twig', [
            'agriculteur' => $agriculteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_agriculteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Agriculteur $agriculteur, AgriculteurRepository $agriculteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agriculteur->getId(), $request->request->get('_token'))) {
            $agriculteurRepository->remove($agriculteur, true);
        }

        return $this->redirectToRoute('app_agriculteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
