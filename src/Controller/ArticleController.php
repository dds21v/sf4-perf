<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article", name="app_article", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success', 'Votre article a bien été ajouté !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_show', ['slug' => $article->getSlug()]);
        }



        return $this->render(
            "article/new.html.twig",
            [
                'createForm'=> $form->createView()
            ]
        );
    }

    /**
     * @Route("/article/{slug}/editarticle", name="app_editarticle", methods={"GET","POST"})
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function edit(Article $article, Request $request): Response
    {
        //récupération du formulaire
        $form = $this->createForm(ArticleType::class, $article);
        //remplir le formulaire avec les variables $_POST
        $form->handleRequest($request);

        //On vérifie que le formulaire est soumis et validé
        if ($form->isSubmitted() && $form->isValid()) {
            //récupération du manager
            $entityManager = $this->getDoctrine()->getManager();
            // Maj de la bdd
            $entityManager->flush();
            // Ajout du message flash
            $this->addFlash('success', 'Votre article a bien été modifié !');

            /*return $this->redirectToRoute('app_home');*/
            return $this->redirectToRoute('app_show', ['slug' => $article->getSlug()]);
        }


        return $this->render('article/udpate.html.twig', [
            'editForm' => $form->createView()
        ]);
    }

    /**
     * @Route ("/article/{slug}/delete", name= "app_delete")
     * @param Article $article
     * @return Response
     */
    public function delete(Article $article): Response
    {
        //Récupération du manager
        $manager = $this->getDoctrine()->getManager();
        //Suppression de l'article
        $manager->remove($article);
        $manager->flush();
        //Redirection de la liste des articles
        return $this->redirectToRoute('app_home');
    }
}
