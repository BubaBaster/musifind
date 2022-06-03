<?php
namespace App\Controller;

use App\Entity\Profile;
use App\Entity\Users;
use App\Form\LoginType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);
        $errors = array();
        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->entityManager->getRepository(Users::class)->findOneBy([
                "login"=>$form->get('login')->getData()
            ]);
            if ($user)
            {
                array_push($errors,"Пользователь с таким логином существует!");
            } else {
                if($form->get('password')->getData() == $form->get('password_confirm')->getData())
                {
                   $new_user = new Users();
                   $new_user->setFullName($form->get('fullName')->getData())
                       ->setLogin($form->get('login')->getData())
                       ->setPassword(password_hash($form->get('password')->getData(),PASSWORD_DEFAULT));
                   $profile = new Profile();
                   $profile->setAbout(null)
                       ->setSex(null)
                       ->setCity(null)
                       ->setAge(null);
                   $new_user->setProfile($profile);
                   $this->entityManager->persist($new_user);
                   $this->entityManager->flush();
                   return $this->redirectToRoute("auth");
                } else {
                    array_push($errors,"Не совпадают!");
                }
            }
        }

        return $this->render("users/register.html.twig",[
            "form"=>$form->createView(),
            "errors"=>$errors,
        ]);
    }




}
