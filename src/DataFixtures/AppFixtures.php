<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        //for ($i=0; $i<50; $i++) {
         //   $article = new Article();
          //  $article->setTitle('Titre de l\'article');
            //$article->setContent('Contenu de l\'article');
            //$article->setIsPublished(true);

            //$manager->persist($article);
        //}

        //for ($i=0; $i<100; $i++) {
          //  $comment = new Comment();
            //$comment->setArticle($article);
            //$comment->setContent('Contenu du Commentaire');


            //$manager->persist($comment);
        //}

        //$manager->flush();

        $generator = Factory::create('fr_FR');
        $populator = new Populator($generator, $manager);

        $populator->addEntity(Article::class, 150, [
            'title' => function () use ($generator) {
                return $generator->text(64);
            }
        ]);
        $populator->addEntity(Comment::class, 500);

        $populator->execute();
    }
}
