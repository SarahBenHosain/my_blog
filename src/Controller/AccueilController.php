<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
         
        return $this->render('accueil/index.html.twig', [
           
        ]);
    }
    
    #[Route('/actualites', name: 'app_actualites')]
public function actualites(): Response
{
    // Récupérez les 4 premiers articles depuis la base de données
    $entityManager = $this->getDoctrine()->getManager();
    $articleRepository = $entityManager->getRepository(Article::class);
    $articles = $articleRepository->findBy([], null, 4);

    return $this->render('accueil/actualites.html.twig', [
        'articles' => $articles,
    ]);
}

    
}
