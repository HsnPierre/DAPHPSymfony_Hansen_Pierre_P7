<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Service\APIGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\ResourceValidationException;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
        $limit = 3;
        return $api->listAction($customer, $params, $request, $paginator, $limit);
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
        $message = null;
        
        foreach($violations as $violation)
        {
            if(null !== $violation->getCode())
            {
                $error_field = $violation->getPropertyPath();
                $tmp = json_encode($violation->getConstraint());
                $error_type = json_decode($tmp, true);
                $message .= 'Exception in the value "'.$error_field.'". '.$error_type['message'].' ';
            }
        }
        if($message !== null)
        {
            throw new ResourceValidationException($message);
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
        $errors = null;
        
        foreach($violations as $violation)
        {
            if(null !== $violation->getCode() && $violation->getInvalidValue() !== $customer->getEmail() && $violation->getInvalidValue() !== $customer->getUsername())
            {
                $error_field = $violation->getPropertyPath();
                $tmp = json_encode($violation->getConstraint());
                $error_type = json_decode($tmp, true);
                $errors[] = 'Exception in the value "'.$error_field.'". '.$error_type['message'];
            }
        }
        if($errors !== null)
        {
            $error = json_encode($errors);
            return new Response($error, Response::HTTP_BAD_REQUEST);
        }
        
        if($customer->getClient()==$this->getUser())
        {
            return $api->updateAction($customer_change, $customer);
        }
        else
        {
            return new Response(json_encode("You don't have the permission to update this customer"), Response::HTTP_FORBIDDEN);
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
            return new Response(json_encode("You don't have the permission to delete this customer"), Response::HTTP_FORBIDDEN);
        }
    }
}
