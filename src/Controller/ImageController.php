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

class ImageController extends AbstractController
{
    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete($id)
    {
        $image = new Image();
        $image = $this->entityManager->getRepository(Image::class)->find($id);
        unlink($this->getParameter('images_directory')."\\".$image->getPath());
        $this->entityManager->remove($image);
        $this->entityManager->flush();
        return $this->redirectToRoute('profile');
    }
    public function avatar($imageId,$profileId)
    {
        $profile = $this->entityManager->getRepository(Profile::class)->find($profileId);
        $images = $profile->getImages();
        foreach ($images as $image)
        {
            if ($image->getId() == $imageId)
            {
                $image->setPriority(1);
            } else {
                $image->setPriority(0);
            }
            $this->entityManager->persist($image);
        }
        $this->entityManager->flush();
        return $this->redirectToRoute('profile');
    }

}
