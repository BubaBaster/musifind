<?php
namespace App\Controller;

use App\Entity\FavouriteGenres;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavouriteGenresController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function delete($id): Response
    {

        $genre = $this->entityManager->getRepository(FavouriteGenres::class)->find($id);
        $this->entityManager->remove($genre);
        $this->entityManager->flush();
        $this->addFlash("genres","Удалено");
        return $this->redirectToRoute("profile");
    }

}