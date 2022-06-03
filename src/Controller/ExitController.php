<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExitController extends AbstractController
{

    public function index(): Response
    {
        setcookie("login","bruh",time()-3600);
        setcookie("password","bruh",time()-3600);
        setcookie("fullName","bruh",time()-3600);
        return $this->redirectToRoute("auth");
    }

}
