<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleListController extends AbstractController
{
    public function listarticle(): Response
    {
        return $this->render('listarticle.html.twig');
    }
}
