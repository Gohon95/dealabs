<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin", name="admin_")
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

     /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UsersRepository $user) {
        return $this->render("admin/users.html.twig",[
            'users' => $user->findAll()
        ]);
    }

     /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(Request $request, Users $user, EntityManagerInterface  $em) {
       
        $form = $this->createForm(EditUserType::class,$user);
  
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $em->flush();
  
          return $this->redirectToRoute('admin_utilisateurs');
        }
  
        return $this->render('admin/editUser.html.twig', ['formUser' => $form->createView()]);
      }
}