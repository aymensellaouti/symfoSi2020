<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/first")
     */
    public function first() {
        $response =  new Response();
        $response->setContent('<h1>Cc Forma</h1>');
        return $response;
    }

}