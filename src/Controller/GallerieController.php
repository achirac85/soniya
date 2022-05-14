<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GallerieController extends AbstractController
{
    /**
     * @Route("/gallerie", name="gallerie")
     */
    public function gallerie(): Response
    {
        return $this->render('gallerie/gallerie.html.twig');
    }
}
