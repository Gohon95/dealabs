<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    public $articleRepository;

public function __construct(ArticleRepository $articleRepository)
{
      $this->articleRepository = $articleRepository;
}

    /**
     * @Route("/comment/new/{id}", name="comment_new")
     * @param Request $request
     * @return Response
     */
    public function new(int $id, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article = $this->articleRepository->find($id);
            $comment->setArticle($article);

            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('comment/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

/**
     * @Route("comment/{id}/edit", name="comment_edit")
     * @param Comment $comment
     * @param Request $request
     * @return Response
     */
    public function edit(Comment $comment, Request $request): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render("comment/edit.html.twig", [
            "form" => $form->createView()
        ]);
    }

}