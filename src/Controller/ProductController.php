<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{    
    /**
     * @Route("/api/products/{id}", name="product_show")
     * @Method({"GET"})
     */
    public function showProduct(Product $product)
    {
        $data = $this->get('serializer')->serialize($product, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/products", name="product_list")
     * @Method({"GET"})
     */
    public function listProduct()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $data = $this->get('serializer')->serialize($products, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
