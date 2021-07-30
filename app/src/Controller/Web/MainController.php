<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
     /**
      * @Route("/")
      */
    public function main(): Response
    {
        $number = random_int(0, 100);

        return $this->render('base.html.twig', []);
    }
}
