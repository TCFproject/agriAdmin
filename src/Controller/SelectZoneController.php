<?php

namespace App\Controller;

use App\Repository\AgriculteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/select/zone")
 */
class SelectZoneController extends AbstractController
{
    /**
     * @Route("/", name="app_select_zone")
     */
    public function index(AgriculteurRepository $agriculteurRepository): Response
    {
        return $this->render('select_zone/index.html.twig', [
            'controller_name' => 'SelectZoneController',
            'agriculteurs' => $agriculteurRepository->findAll()

        ]);
    }
}
