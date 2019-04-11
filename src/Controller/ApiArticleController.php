<?php


namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiArticleController extends AbstractController
{
    /**
     * @Route("/api/article/likes/{slug}")
     * @return JsonResponse
     */
    public function incrementLikes($slug): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository->findOneBy([
           'slug'=> $slug
        ]);
        $likes= $article->getLikes() + 1;
        $article->setLikes($likes);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($article);
        $manager->flush();

        return $this->json([
            'cpt' => $likes
        ]);
    }
}
