<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\ArticleType;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Egulias\EmailValidator\Parser\Comment;
use Symfony\Component\HttpFoundation\Request;


class ArticlesController extends AbstractController
{


    #[Route('/articles', name: 'app_articles')]
    public function articles(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager->getRepository(Article::class)->findAll();
        
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/{id}', name: 'app_article')]
    public function article(ArticleRepository $articleRepository, int $id, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $article = $articleRepository->find($id);
        $comment = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setArticle($article);
            // $comment->setDate(new \DateTime());
            $comment->setAuteur($this->getUser());
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->render('articles/article.html.twig', [
            'article' => $article,
            'form' => $form
        ]);
    }

    // #[Route('/articles/add', name: 'app_add_article')]
    // public function addArticle(Request $request, FormFactoryInterface $formFactory): Response
    // {
    //     // Check if the user has the role to manage articles
    //     if (!$this->getUser()->canManageArticles()) {
    //         throw $this->createAccessDeniedException('You do not have the required role to manage articles.');
    //     }

    //     // Créez une nouvelle instance de l'entité Article
    //     $article = new Article();

    //     // Créez le formulaire en utilisant le service FormFactory
    //     $form = $formFactory->create(ArticleType::class, $article);

    //     // Gérez la soumission du formulaire
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Sauvegardez l'article dans la base de données
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($article);
    //         $entityManager->flush();

    //         // Redirigez après la soumission réussie
    //         return $this->redirectToRoute('app_articles');
    //     }

    //     // Rendez la vue du formulaire avec le formulaire
    //     return $this->render('articles/add.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }



    // #[Route('/articles/delete/{id}', name: 'app_delete_article')]
    // public function deleteArticle(int $id): Response
    // {
    //     // Check if the user has the role to manage articles
    //     if (!$this->getUser()->canManageArticles()) {
    //         throw $this->createAccessDeniedException('You do not have the required role to manage articles.');
    //     }



    //     return $this->redirectToRoute('app_articles');
    // }
}
