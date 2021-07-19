<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class APIController extends AbstractController
{
    /**
     * @Route("/documentation")
     */
    public function index()
    {
        return $this->render('documentation/index.html.twig');
    }
}