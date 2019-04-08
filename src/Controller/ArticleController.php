<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    /**
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @param Request $request
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        return $this->render("article/new.html.twig", [   'createForm'    => $form->createView() ]);
    }
}
