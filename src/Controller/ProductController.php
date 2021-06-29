<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\APIGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{    
    /**
     * @Rest\Get(
     *      path = "/api/products/{id}",
     *      name = "product_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups={"details"})
     */
    public function showProduct(APIGenerator $api, Product $product)
    {
        return $api->showAction($product);
    }

    /**
     * @Rest\Get(
     *      path = "/api/products",
     *      name = "products_list"
     * )
     * @Rest\View(serializerGroups={"list"})
     */
    public function listProduct(APIGenerator $api, Request $request, PaginatorInterface $paginator)
    {
        $product = new Product();
        $params = [];
        return $api->listAction($product, $params, $request, $paginator);
    }
}
