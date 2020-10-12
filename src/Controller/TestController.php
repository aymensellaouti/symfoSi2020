<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/first")
     */
    public function first() {
        $response =  new Response();
        $response->setContent('<h1>Cc Forma</h1>');
        return $response;
    }

    /**
     * @Route("/notes/{nombre<[1-9]\d*>}",
     *     name="notes",
     *     defaults={"nombre":"5"}
     * )
     */
    public function notes($nombre) {
        // Créer un tableau aléatoire de nombre cases
        $notes = [];
        for($i=0; $i<$nombre;$i++)  {
            $notes[$i] = rand(0,20);
        }
        return $this->render('notes/index.html.twig', [
            'notes' => $notes
        ]);
    }

}