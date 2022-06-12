<?php
namespace App\Controller;

use App\Entity\FavouriteGenres;
use App\Entity\Genres;
use App\Entity\Users;
use App\Form\SearchByGenreType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function index(Request $request): Response
    {

        $search = false;
        $user = $this->entityManager->getRepository(Users::class)->findOneBy([
            "login"=>$_COOKIE['login']
        ]);
        $profile = $user->getProfile();

        $form = $this->createForm(SearchByGenreType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $genre = $form->get("genre")->getData();
            $correctUsers = new ArrayCollection();
            $users = $this->entityManager->getRepository(Users::class)->findAll();
            foreach ($users as $user1)
            {
                $userGenres = $user1->getProfile()->getFavouriteGenres();
                foreach ($userGenres as $userGenre)
                {
                    if ($userGenre->getGenre() == $genre)
                    {
                        $correctUsers->add($user1);
                    }
                }
            }
            $search = true;
            if (count($correctUsers)>0)
            {
                return $this->render("main_page/search_page.html.twig",[
                        "login"=>$_COOKIE['login'],
                        "fullName"=>$_COOKIE['fullName'],
                        "users"=>$users,
                        "profile"=>$profile,
                        "usersHigh"=>null,
                        "usersMid"=>null,
                        "usersLow"=>null,
                        "correctUsers"=>$correctUsers,
                        "search"=>$search,
                        "form"=>$form->createView(),

                    ]
                );
            } else{
                $this->addFlash("error","Пользователи не найдены");
            }
        }

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
                "search"=>$search,
                "correctUsers"=>null,
                "form"=>$form->createView(),

            ]
        );
    }

    public function search($id): Response
    {
        $user = $this->entityManager->getRepository(Users::class)->findOneBy([
            "login"=>$_COOKIE['login']
        ]);
        $profile = $user->getProfile();

        $genre = $this->entityManager->getRepository(Genres::class)->find($id);
        $correctUsers = new ArrayCollection();
        $users = $this->entityManager->getRepository(Users::class)->findAll();
        foreach ($users as $user1)
        {
            $userGenres = $user1->getProfile()->getFavouriteGenres();
            foreach ($userGenres as $userGenre)
            {
                if ($userGenre->getGenre() == $genre)
                {
                    $correctUsers->add($user1);
                }
            }
        }
        if (count($correctUsers)>0)
        {
            return $this->render("main_page/search_results.html.twig",[
                    "login"=>$_COOKIE['login'],
                    "fullName"=>$_COOKIE['fullName'],
                    "profile"=>$profile,
                    "users"=>$correctUsers,

                ]
            );
        } else{
            $this->addFlash("error","Пользователи не найдены");
        }
    }

}