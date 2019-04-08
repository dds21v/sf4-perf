<?php


namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        // Récupération du Repository
        $repository = $this->getDoctrine()->getRepository(Article::class);

        // Récupération de tout les articles
        $article = $repository->findOneBy([
            'slug'=> $slug
        ]);

        // Renvoi des articles à la vue
        return $this->render(
            'article/show.html.twig',
            [
                'article'=>$article
            ]
        );
    }
}
