<?php

namespace App\Controller;

use App\Entity\CommentaireEvent;
use App\Form\CommentaireEvent1Type;
use App\Repository\CommentaireEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commentaire/event')]
class CommentaireEventController extends AbstractController
{
    #[Route('/', name: 'app_commentaire_event_index', methods: ['GET'])]
    public function index(CommentaireEventRepository $commentaireEventRepository): Response
    {
        return $this->render('commentaire_event/index.html.twig', [
            'commentaire_events' => $commentaireEventRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commentaire_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaireEvent = new CommentaireEvent();
        $form = $this->createForm(CommentaireEvent1Type::class, $commentaireEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaireEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_commentaire_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentaire_event/new.html.twig', [
            'commentaire_event' => $commentaireEvent,
            'form' => $form,
        ]);
    }
    
    // #[Route('/{id}', name: 'app_commentaire_event_show', methods: ['GET'])]
    // public function show(CommentaireEvent $commentaireEvent): Response
    // {
    //     return $this->render('commentaire_event/show.html.twig', [
    //         'commentaire_event' => $commentaireEvent,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_commentaire_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommentaireEvent $commentaireEvent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentaireEvent1Type::class, $commentaireEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commentaire_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commentaire_event/edit.html.twig', [
            'commentaire_event' => $commentaireEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_event_delete', methods: ['POST'])]
    public function delete(Request $request, CommentaireEvent $commentaireEvent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireEvent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commentaireEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commentaire_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
