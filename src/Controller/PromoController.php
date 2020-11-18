<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Form\PromoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoController extends AbstractController
{
    /**
     * @Route("/promo/new", name="promo_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $promo = new Promo();
        $form = $this->createForm(PromoType::class, $promo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('promo/new.html.twig', [
            "form" => $form->createView()
        ]);
    }
}