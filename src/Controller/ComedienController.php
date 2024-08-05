<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ComedienController extends AbstractController
{
    #[Route('/comedien', name: 'app_comedien')]
    public function index(): Response
    {
        return $this->render('comedien/index.html.twig', [
            'controller_name' => 'ComedienController',
        ]);
    }
}
