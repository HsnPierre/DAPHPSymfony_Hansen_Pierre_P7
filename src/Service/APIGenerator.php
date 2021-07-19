<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;

class APIGenerator extends AbstractController
{    

    public function showAction(Object $entity)
    {
        $entity->setUri("/api/".$entity->getType()."s/".$entity->getId());
        return $entity;
    }

    public function listAction(Object $entity, array $params, Request $request, PaginatorInterface $paginator, int $limit)
    {
        if($entity->getType()=='customer')
        $entities = $this->getDoctrine()->getRepository(Customer::class)->findBy($params);
        else
        $entities = $this->getDoctrine()->getRepository(Product::class)->findBy($params);

        foreach($entities as $entity)
        {
            $entity->setUri("/api/".$entity->getType()."s/".$entity->getId());
        }

        $page = $request->query->get('page') ?? 1;

        $pag_entities = $paginator->paginate($entities, $request->query->getInt('page', $page), $request->query->getInt('limit', $limit));

        return $pag_entities;
    }

    public function createAction(Object $entity)
    {      
        $entity->setClient($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $entity->setUri("/api/".$entity->getType()."s/".$entity->getId());
        return $entity;
    }

    public function updateAction(Object $entity2, Object $entity)
    {       
        $entity->setEmail($entity2->getEmail());
        $entity->setUsername($entity2->getUsername());

        $this->getDoctrine()->getManager()->flush();

        $entity->setUri("/api/".$entity->getType()."s/".$entity->getId());
        return $entity;
    }

    public function deleteAction(Object $entity)
    {
        $this->getDoctrine()->getManager()->remove($entity);
        $this->getDoctrine()->getManager()->flush();

        return;

    }
}
