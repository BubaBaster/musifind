<?php
namespace App\Controller;

use App\Entity\FavouriteGenres;
use App\Entity\Image;
use App\Entity\Likes;
use App\Entity\Profile;
use App\Entity\Users;
use App\Form\ImageType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $user = $this->entityManager->getRepository(Users::class)->findOneBy([
            "login"=>$_COOKIE['login']
        ]);
        $profile = $user->getProfile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $profile = $form->getData();
            $this->entityManager->persist($profile);
            $this->entityManager->flush();
            if ($form->get('genres')->getData() != null)
            {
                $genres = $form->get('genres')->getData();
                foreach ($genres as $genre)
                {
                    $favouriteGenre = new FavouriteGenres();
                    $favouriteGenre->setIdProfile($profile);
                    $favouriteGenre->setGenre($genre);
                    $profile->addFavouriteGenre($favouriteGenre);
                    $this->entityManager->persist($favouriteGenre);
                }
                $this->entityManager->flush();
                return $this->redirect($request->getUri());

            }
        }


        $formImg = $this->createForm(ImageType::class);
        $formImg->handleRequest($request);
        if($formImg->isSubmitted())
        {
            if (!$formImg->isValid()){
                return $this->render("main_page/profile_page.html.twig",[
                        "login"=>$_COOKIE['login'],
                        "fullName"=>$_COOKIE['fullName'],
                        "form"=>$form->createView(),
                        "profile"=>$profile,
                        "formImg"=>$formImg->createView(),
                        "fileError"=>true,
                        "fileMessage"=>"Размер изображения должен быть меньше или равен 4МБ",
                        "likes"=>$this->entityManager->getRepository(Likes::class)->findAll(),

                    ]
                );
            }
            $images = $formImg->get('image')->getData();

            if (count($images)>5)
            {
                return $this->render("main_page/profile_page.html.twig",[
                        "login"=>$_COOKIE['login'],
                        "fullName"=>$_COOKIE['fullName'],
                        "form"=>$form->createView(),
                        "profile"=>$profile,
                        "formImg"=>$formImg->createView(),
                        "fileError"=>true,
                        "fileMessage"=>"Максимальное количество файлов 5!",
                        "likes"=>$this->entityManager->getRepository(Likes::class)->findAll(),

                    ]
                );
            }
            foreach($images as $image){

                $img = new Image();
                $fileName = md5(uniqid()).'.'.$image->guessExtension();
                $img->setProfile($profile);
                $img->setPath($fileName);
                $img->setPriority(0);

                $image->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $this->entityManager->persist($img);
                $this->entityManager->flush();

            }
            return $this->redirectToRoute("profile");
        }

        return $this->render("main_page/profile_page.html.twig",[
                "login"=>$_COOKIE['login'],
                "fullName"=>$_COOKIE['fullName'],
                "form"=>$form->createView(),
                "profile"=>$profile,
                "formImg"=>$formImg->createView(),
                "likes"=>$this->entityManager->getRepository(Likes::class)->findAll(),

            ]
        );
    }
    public function getProfile($id)
    {
        $myUser = $this->entityManager->getRepository(Users::class)->findOneBy([
            'login'=>$_COOKIE['login']
        ]);
        $profile = $this->entityManager->getRepository(Profile::class)->find($id);
        if ($profile!=null)
        {
            return $this->render("main_page/profileSearch.html.twig",[
                    "login"=>$_COOKIE['login'],
                    "fullName"=>$_COOKIE['fullName'],
                    "profile"=>$profile,
                    "user"=>$myUser
                ]
            );
        } else {
            $this->redirectToRoute("search");
        }
    }

}
