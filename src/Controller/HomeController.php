<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentFrontType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function home(Request $request, PaginatorInterface $paginator)
    {
        // Récupération du Repository
        //$repository = $this->getDoctrine()->getRepository(Article::class);

       // $query= $repository->getQueryAll();

        // Récupération de tout les articles
        //$articles = $repository->findAll();  // Because of paginator

        //$paginator  = $this->get('knp_paginator');
        //$pagination = $paginator->paginate(
            //$query, /* query NOT result */
          //  $request->query->getInt('page', 1), /*page number*/
            //9 /*limit per page*/
        //);

        $em    = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM App\Entity\Article a";
        $query = $em->createQuery($dql);

        //$paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );



        // Renvoi des articles à la vue
        return $this->render(
            'home.html.twig',
            [
                'pagination'=>$pagination
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
