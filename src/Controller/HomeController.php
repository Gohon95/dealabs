<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ArticleRepository $articleRepository
     * @return Response
     */

    public function home(ArticleRepository $articleRepository) 
    {

        return $this->render('index.html.twig', [
            "articles" => $articleRepository->findAll()
        ]);      
    }
}
