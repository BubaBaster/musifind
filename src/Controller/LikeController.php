<?php
namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LikeController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index($id)
    {
        $myUser = $this->entityManager->getRepository(Users::class)->findOneBy([
            'login'=>$_COOKIE['login']
        ]);
        $userLiked = $this->entityManager->getRepository(Users::class)->find($id);
        $like = new Likes();
        $like->setUser($myUser)->setUserLiked($userLiked)->setStatus(0)->setDate(new \DateTime());
        $this->entityManager->persist($like);
        $this->entityManager->flush();
        return $this->redirect("/profile/".$userLiked->getId());

    }

    public function delete($id)
    {
        $myUser = $this->entityManager->getRepository(Users::class)->findOneBy([
            'login'=>$_COOKIE['login']
        ]);
        $userLiked = $this->entityManager->getRepository(Users::class)->find($id);
        $like = $this->entityManager->getRepository(Likes::class)->findOneBy([
            "user"=>$myUser->getId(),
            "userLiked"=>$userLiked->getId()
        ]);

        $this->entityManager->remove($like);
        $this->entityManager->flush();
        return $this->redirect("/profile/".$userLiked->getId());

    }

}
