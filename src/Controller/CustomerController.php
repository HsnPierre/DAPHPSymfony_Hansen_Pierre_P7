<?php

namespace App\Controller;

use App\Entity\Customer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{    
    /**
     * @Route("/api/customers/{id}", name="customer_show")
     * @Method({"GET"})
     */
    public function showCustomer(Customer $customer)
    {
        $data = $this->get('serializer')->serialize($customer, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/customers", name="customer_list")
     * @Method({"GET"})
     */
    public function listCustomer()
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        $data = $this->get('serializer')->serialize($customers, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/customers", name="customer_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $customer = $this->$this->get('serializer')->deserialize($data, 'App\Entity\Customer', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/customers/{id}", name="customer_create")
     * @Method({"PUT","PATCH"})
     */
    public function updateAction(Request $request)
    {
        $data = $request->getContent();
        $customer = $this->$this->get('serializer')->deserialize($data, 'App\Entity\Customer', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/api/customers/{id}", name="customer_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction()
    {
        $data = $request->getContent();
        $customer = $this->$this->get('serializer')->deserialize($data, 'App\Entity\Customer', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->remove($customer);
        $em->flush();

        return new Response();

    }
}
