<?php
namespace App\Controller;

use App\Entity\FavouriteGenres;
use App\Entity\Users;
use Doctrine\Common\Collections\ArrayCollection;
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
        $usersHigh = new ArrayCollection();
        $usersMid = new ArrayCollection();
        $usersLow = new ArrayCollection();
        $genresCount = count($userGenres);
        foreach ($users as $userAnother)
        {
            $anotherGenres = $userAnother->getProfile()->getFavouriteGenres();
            $genreAnotherCount = 0;
            foreach ($anotherGenres as $genreAnother)
            {

                if ($this->entityManager->getRepository(FavouriteGenres::class)->findOneBy([
                    "idProfile"=>$profile->getId(),
                    "Genre"=>$genreAnother->getGenre()->getId(),
                ]) != null)
                {
                    $genreAnotherCount++;
                }
            }
            if ($genreAnotherCount != 0 && $genreAnotherCount/$genresCount > 0.6)
            {
                $usersHigh->add($userAnother);
            }
            if ($genreAnotherCount != 0 && $genreAnotherCount/$genresCount <= 0.6 && $genreAnotherCount/$genresCount>0.3)
            {
               $usersMid->add($userAnother);
            }
            if ($genreAnotherCount != 0 && $genreAnotherCount/$genresCount <= 0.3 && $genreAnotherCount/$genresCount>0)
            {
                $usersLow->add($userAnother);
            }
        }


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