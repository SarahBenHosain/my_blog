<?php
namespace App\Controller;
use App\Entity\Comment; 
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/create', name: 'comment_create')]
    public function createComment(Request $request): Response
    {
        $comment = new Comment();

        // Créez le formulaire en utilisant CommentType
        $form = $this->createForm(CommentType::class, $comment);

        // Gérez la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // définir l'auteur du commentaire ici
            $comment->setAuthor($this->getUser());

            // Enregistrez le commentaire dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_article', ['id' => $comment->getArticle()->getId()]);
        }

        return $this->render('comment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
