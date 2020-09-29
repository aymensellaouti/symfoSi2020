<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiController extends AbstractController
{
    /**
     * @Route("/si", name="si")
     */
    public function index()
    {
        return $this->render('si/index.html.twig');
    }

    /**
     * @Route("/hello")
     */
    public function sayHello() {
        return $this->render('si/Hello.html');
    }
}
