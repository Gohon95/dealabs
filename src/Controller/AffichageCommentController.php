<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageCommentController extends AbstractController
{
    /**
     * @Route("/affichagecomment", name="affichage_comment")
     * @param CommentRepository $commentRepository
     * @return Response
     */
    public function affichagecomment(CommentRepository $commentRepository) 
    {     
        
        return $this->render('/comment/index.html.twig', [
            "comments" => $commentRepository->findAll()
        ]);
    }
}
