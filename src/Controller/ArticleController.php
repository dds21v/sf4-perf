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
     * @return Response
     */
    public function edit(): Response
    {
        return $this->render('article/udpate.html.twig');
    }
}
