<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichagePromoController extends AbstractController
{
    /**
     * @Route("/affichagepromo", name="affichage_promo")
     * @param PromoRepository $promoRepository
     * @return Response
     */
    public function affichagepromo(PromoRepository $promoRepository) 
    {     
        
        return $this->render('promo/index.html.twig', [
            "promos" => $promoRepository->findAll()
        ]);
    }
}
