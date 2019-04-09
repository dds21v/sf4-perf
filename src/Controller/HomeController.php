<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentFrontType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @return Response
     */
    public function home(): Response
    {
        // Récupération du Repository
        $repository = $this->getDoctrine()->getRepository(Article::class);

        // Récupération de tout les articles
        $articles = $repository->findAll();

        // Renvoi des articles à la vue
        return $this->render(
            'home.html.twig',
            [
                'articles'=>$articles
            ]
        );
    }

    /**
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function show(Article $article, Request $request): Response
    {
        // Récupération du Repository
      //  $repository = $this->getDoctrine()->getRepository(Article::class);
        // $repository = $this->getDoctrine()->getRepository(Comment::class);
        // Récupération de tout les articles
      //  $article = $repository->findOneBy([
       //     'slug'=> $slug
        //]);

        //création du formulaire pour l'ajout de commentaire
        $newComment = new Comment();
        $newComment->setArticle($article);
        $commentForm = $this->createForm(CommentFrontType::class);

        //Gestion de l'ajout du commentaire
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newComment);
            $entityManager->flush();
        }

        // Renvoi des articles à la vue
        return $this->render(
            'article/show.html.twig',
            [
                'article'=>$article,
                'commentForm'=> $commentForm->createView()
            ]
        );
    }
}
