<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\APIGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\ResourceValidationException;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractController
{    
    /**
     * @Rest\Get(
     *      path = "/api/users/{id}",
     *      name = "user_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups={"details"})
     */
    public function showUser(APIGenerator $api, User $user)
    {
        return $api->showAction($user);
    }

    /**
     * @Rest\Get(
     *      path = "/api/users",
     *      name = "users_list"
     * )
     * @Rest\View(serializerGroups={"list"})
     */
    public function listUser(APIGenerator $api, Request $request, PaginatorInterface $paginator)
    {
        $user = new User();
        $params = ['client' => $this->getUser()];
        $limit = 3;
        return $api->listAction($user, $params, $request, $paginator, $limit);
    }

    /**
     * @Rest\Post(
     *      path = "/api/users",
     *      name = "users_create"
     * )
     * @Rest\View(StatusCode = 201, serializerGroups={"details"})
     * @ParamConverter(
     *      "user", 
     *      converter = "fos_rest.request_body"
     * )
     */
    public function createUser(APIGenerator $api, User $user, ConstraintViolationList $violations)
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
            return new JsonResponse(['code' => 400,'message' => $message], 400);
        }

        return $api->createAction($user);
    }

    /**
     * @Rest\Put(
     *      path = "/api/users/{id}",
     *      name = "user_update",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200, serializerGroups={"details"})
     * @ParamConverter("user_change", converter="fos_rest.request_body")
     */
    public function updateUser(APIGenerator $api, User $user_change, User $user, ConstraintViolationList $violations)
    {       
        $message = null;
        
        foreach($violations as $violation)
        {
            if(null !== $violation->getCode() && $violation->getInvalidValue() !== $user->getEmail() && $violation->getInvalidValue() !== $user->getUsername())
            {
                $error_field = $violation->getPropertyPath();
                $tmp = json_encode($violation->getConstraint());
                $error_type = json_decode($tmp, true);
                $message .= 'Exception in the value "'.$error_field.'". '.$error_type['message'];
            }
        }
        if($message !== null)
        {
            return new JsonResponse(['code' => 400,'message' => $message], 400);
        }
        
        if($user->getClient()==$this->getUser())
        {
            return $api->updateAction($user_change, $user);
        }
        else
        {
            return new JsonResponse(['code' => 403,'message' => "You don't have the permission to access this user"], 403);
        }
    }

    /**
     * @Rest\Delete(
     *      path = "/api/users/{id}",
     *      name = "user_delete",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 204)
     */
    public function deleteUser(APIGenerator $api, User $user)
    {
        if($user->getClient()==$this->getUser())
        {
            return $api->deleteAction($user);
        }
        else
        {
            return new JsonResponse(['code' => 403,'message' => "You don't have the permission to access this user"], 403);
        }
    }
}
