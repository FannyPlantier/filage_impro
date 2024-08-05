<?php

namespace App\Controller;

use App\Entity\Comedien;
use App\Form\ComedienType;
use App\Repository\ComedienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/comedien')]
class ComedienController extends AbstractController
{
    #[Route('/', name: 'app_comedien_index', methods: ['GET'])]
    public function index(ComedienRepository $comedienRepository): Response
    {
        return $this->render('comedien/index.html.twig', [
            'comediens' => $comedienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comedien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comedien = new Comedien();
        $form = $this->createForm(ComedienType::class, $comedien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comedien);
            $entityManager->flush();

            return $this->redirectToRoute('app_comedien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comedien/new.html.twig', [
            'comedien' => $comedien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comedien_show', methods: ['GET'])]
    public function show(Comedien $comedien): Response
    {
        return $this->render('comedien/show.html.twig', [
            'comedien' => $comedien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comedien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comedien $comedien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ComedienType::class, $comedien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_comedien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comedien/edit.html.twig', [
            'comedien' => $comedien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comedien_delete', methods: ['POST'])]
    public function delete(Request $request, Comedien $comedien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comedien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($comedien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_comedien_index', [], Response::HTTP_SEE_OTHER);
    }
}
