<?php

namespace App\Controller;

use App\Entity\Highlight;
use App\Form\HighlightType;
use App\Repository\HighlightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/highlight')]
class HighlightController extends AbstractController
{
    #[Route('/', name: 'highlight_index', methods: ['GET'])]
    public function index(HighlightRepository $highlightRepository): Response
    {
        return $this->render('highlight/index.html.twig', [
            'highlights' => $highlightRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'highlight_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $highlight = new Highlight();
        $form = $this->createForm(HighlightType::class, $highlight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($highlight);
            $entityManager->flush();

            return $this->redirectToRoute('highlight_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('highlight/new.html.twig', [
            'highlight' => $highlight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'highlight_show', methods: ['GET'])]
    public function show(Highlight $highlight): Response
    {
        return $this->render('highlight/show.html.twig', [
            'highlight' => $highlight,
        ]);
    }

    #[Route('/{id}', name: 'highlight_show_by_projectId', methods: ['GET'])]
    public function showByProjectIs(Highlight $highlight): Response
    {
        return $this->render('highlight/show.html.twig', [
            'highlight' => $highlight,
        ]);
    }

    #[Route('/{id}/edit', name: 'highlight_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Highlight $highlight, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HighlightType::class, $highlight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('highlight_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('highlight/edit.html.twig', [
            'highlight' => $highlight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'highlight_delete', methods: ['POST'])]
    public function delete(Request $request, Highlight $highlight, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$highlight->getId(), $request->request->get('_token'))) {
            $entityManager->remove($highlight);
            $entityManager->flush();
        }

        return $this->redirectToRoute('highlight_index', [], Response::HTTP_SEE_OTHER);
    }
}
