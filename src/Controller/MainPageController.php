<?php
namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPageController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

     public function index(Request $request): Response
     {
         if($this->checkAuth() == false)
         {
             return $this->redirectToRoute("auth");
         }
        return $this->render("main_page/home_page.html.twig",[
                "login"=>$_COOKIE['login'],
                "fullName"=>$_COOKIE['fullName'],

        ]
        );
     }


     public function checkAuth()
     {
         if (isset($_COOKIE['login']) && isset($_COOKIE['password']) && isset($_COOKIE['fullName'])) {
             $user = $this->entityManager->getRepository(Users::class)->findOneBy([
                 "login" => $_COOKIE['login']
             ]);
             if ($user != null) {
                 if (password_verify($_COOKIE['password'], $user->getPassword())) {
                     return true;
                 }
             }
         }else {
             return false;
         }
             return false;
     }




}