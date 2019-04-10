<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function list(UserRepository $userRepository): Response
    {
        //Récupération du repository
        $repo = $this->getDoctrine()->getRepository(User::class);
        //Récupération des utilisateurs
        $users= $repo->findAll();
        // Envoi des utilisateurs à la vue
        return $this->render('list.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }
}
