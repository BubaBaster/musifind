<?php
namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function index(): Response
    {

        $user = $this->entityManager->getRepository(Users::class)->findOneBy([
            "login"=>$_COOKIE['login']
        ]);

        $profile = $user->getProfile();
        $userGenres = $profile->getFavouriteGenres();
        $users = $this->entityManager->getRepository(Users::class)->findAll();
        return $this->render("main_page/search_page.html.twig",[
                "login"=>$_COOKIE['login'],
                "fullName"=>$_COOKIE['fullName'],
                "users"=>$users,
                "profile"=>$profile,
                "usersHigh"=>$usersHigh,
                "usersMid"=>$usersMid,
                "usersLow"=>$usersLow,

            ]
        );
    }

}