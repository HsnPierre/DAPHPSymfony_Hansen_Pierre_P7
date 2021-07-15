<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class APIController extends AbstractController
{
    /**
     * @Route("/api/documentation")
     */
    public function index()
    {
        return $this->render('documentation/index.html.twig');
    }
}