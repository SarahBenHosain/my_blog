<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\EvennementType;
use App\Entity\Evennement;
use App\Repository\EvennementRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\CommentaireEvent;
use App\Form\CommentaireEventType;
use App\Repository\CommentaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Egulias\EmailValidator\Parser\Comment;

class EvennementsController extends AbstractController
{
    #[Route('/evennements', name: 'app_evennements')]
    public function evennements(EntityManagerInterface $entityManager): Response
    {
        $evennements = $entityManager->getRepository(Evennement::class)->findAll();
       
        return $this->render('evennements/index.html.twig', [
            'evennements' => $evennements,
        ]);
    }

    #[Route('/evennements/{id}', name: 'app_evennement')]
    public function evennement(EvennementRepository $evennementRepository, int $id, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $evennement = $evennementRepository->find($id);
        $comment = new CommentaireEvent();
        $form = $this->createForm(CommentaireEventType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setEvennement($evennement);
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->render('evennements/form.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }
}
