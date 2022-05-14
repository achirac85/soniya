<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/product")
 */
class ProductadminController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods= {"GET"} )
     */
    public function index(ProductRepository $productRepository): Response
    {

        return $this->render('productadmin/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="product_new", methods= { "GET","POST"})
     */

    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($fichier = $form->get("picture")->getData()) {

                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= uniqid() . "." . $fichier->guessExtension();
                $fichier->move($this->getParameter("dossier_images"), $nomFichier);
                $product->setPicture($nomFichier);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('productadmin/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="chambre_show", methods= {"GET"})
     */


    public function show(Product $product): Response
    {
        return $this->render('productadmin/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name= "product_edit", methods= {"GET", "POST"})
     */


    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($fichier = $form->get("picture")->getData()) {

                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= uniqid() . "." . $fichier->guessExtension();
                $fichier->move($this->getParameter("dossier_images"), $nomFichier);
                $product->setPicture($nomFichier);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('productadmin/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name= "product_delete", methods= {"POST"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
}
