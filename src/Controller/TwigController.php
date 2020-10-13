<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
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

    /**
     * @Route("colortab", name="tab.color")
     */
    public function personnesListe() {
        $personnes = [
            [
                'name' =>'sellaouti',
                'firstname' =>'aymen',
                'age' =>38,
            ],
            array(
                'name' =>'Bouslahi',
                'firstname' =>'Modtadha',
                'age' =>22,
            ),array(
                'name' =>'Memmiche',
                'firstname' =>'Oumayma',
                'age' =>22,
            ),
        ];
        return $this->render('twig/color.html.twig', [
            'personnes' => $personnes
        ]);
    }

    /**
     * @Route("layout", name="base.layout")
     */
    public function layout(){
        return $this->render('twig/layout.html.twig');
    }

    /**
     * @Route("page1", name="page1")
     */
    public function page1(){
        return $this->render('twig/page1.html.twig');
    }

}
