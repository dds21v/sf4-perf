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
    public function show(Article $article, Request $request)
    {
        // Récupération du Repository
      //  $repository = $this->getDoctrine()->getRepository(Article::class);
        // $repository = $this->getDoctrine()->getRepository(Comment::class);
        // Récupération de tout les articles
      //  $article = $repository->findOneBy([
       //     'slug'=> $slug
        //]);

        //création du formulaire pour l'ajout de commentaire
        $commentForm = $this->createFormComment($article);

        //Gestion de l'ajout du commentaire
        $commentForm->handleRequest($request); //Récupère le POST
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentForm->getData());
            $entityManager->flush();
            $commentForm = $this->createFormComment($article);
        }

        // Renvoi des articles à la vue
        return $this->render(
            'article/show.html.twig',
            [
                'article'=>$article,
                'commentForm'=> $commentForm->createView() //on ajoute la Méthode createView à la variable $commentForm
            ]
        );
    }
    /**
     * Créé un formulaire pour ajouter un nouveau comment à un article
     * @param Article $article
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createFormComment(Article $article)
    {
        // Création d'un nouveau formulaire
        $comment = new Comment(); //instanciation de la classe
        $comment->setArticle($article); //
        return $this->createForm(CommentFrontType::class, $comment);
    }
}
