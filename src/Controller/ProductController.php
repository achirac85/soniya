<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="produit")
     */
    public function produit(): Response
    {
        return $this->render('product/produit.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    
}
