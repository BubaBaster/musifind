<?php
namespace App\Controller;

use App\Entity\Image;
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
        }


        $formImg = $this->createForm(ImageType::class);
        $formImg->handleRequest($request);
        if($formImg->isSubmitted() && $formImg->isValid())
        {
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
                        "fileMessage"=>"Максимальное количество файлов 5!"

                    ]
                );
            }
            foreach($images as $image){

                $img = new Image();
                $fileName = md5(uniqid()).'.'.$image->guessExtension();
                $img->setProfile($profile);
                $img->setPath($fileName);

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

            ]
        );
    }

}
