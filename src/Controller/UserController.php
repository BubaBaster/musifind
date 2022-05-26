<?php
namespace App\Controller;

use App\Entity\Users;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        $errors = array();
        if($form->isSubmitted() && $form->isValid())
        {
            $user = new Users();
            $user = $this->entityManager->getRepository(Users::class)->findOneBy([
                "login"=>$form->get('login')->getData()
            ]);
            if ($user != null) {
                if(password_verify($form->get('password')->getData(),$user->getPassword()))
                {
                    $this->addFlash("success","Авторизовался чепух");
                }
                else {
                    array_push($errors,"Пароль неправильный");
                }
            } else {
                array_push($errors,"Логин не найден");
            }
        }
        return $this->render("users/login.html.twig",[
            "form"=>$form->createView(),
            "errors"=>$errors,
        ]);
    }




}
