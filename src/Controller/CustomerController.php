<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Service\APIGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;

class CustomerController extends AbstractController
{    
    /**
     * @Rest\Get(
     *      path = "/api/customers/{id}",
     *      name = "customer_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups={"details"})
     */
    public function showCustomer(APIGenerator $api, Customer $customer)
    {
        return $api->showAction($customer);
    }

    /**
     * @Rest\Get(
     *      path = "/api/customers",
     *      name = "customers_list"
     * )
     * @Rest\View(serializerGroups={"list"})
     */
    public function listCustomer(APIGenerator $api, Request $request, PaginatorInterface $paginator)
    {
        $customer = new Customer();
        $params = ['client' => $this->getUser()];
        return $api->listAction($customer, $params, $request, $paginator);
    }

    /**
     * @Rest\Post(
     *      path = "/api/customers",
     *      name = "customers_create"
     * )
     * @Rest\View(StatusCode = 201, serializerGroups={"details"})
     * @ParamConverter(
     *      "customer", 
     *      converter = "fos_rest.request_body"
     * )
     */
    public function createCustomer(APIGenerator $api, Customer $customer, ConstraintViolationList $violations)
    {                  
        if(null !== $violations[0]->getCode())
        {
            header("HTTP/1.1 400 Bad Request");
            exit;
        }
        
        return $api->createAction($customer);
    }

    /**
     * @Rest\Put(
     *      path = "/api/customers/{id}",
     *      name = "customer_update",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200, serializerGroups={"details"})
     * @ParamConverter("customer_change", converter="fos_rest.request_body")
     */
    public function updateCustomer(APIGenerator $api, Customer $customer_change, Customer $customer, ConstraintViolationList $violations)
    {       
        if(null !== $violations[0]->getCode())
        {
            header("HTTP/1.1 400 Bad Request");
            exit;
        }
        
        if($customer->getClient()==$this->getUser())
        {
            return $api->updateAction($customer_change, $customer);
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }

    /**
     * @Rest\Delete(
     *      path = "/api/customers/{id}",
     *      name = "customer_delete",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 204)
     */
    public function deleteCustomer(APIGenerator $api, Customer $customer)
    {
        if($customer->getClient()==$this->getUser())
        {
            return $api->deleteAction($customer);
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }
}
