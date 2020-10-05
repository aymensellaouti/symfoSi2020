<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MyNewController extends AbstractController
{
    /**
     * @Route("/my/{name}", name="my_new")
     */
    public function index($name, Request $request)
    {
        echo $request->query->get('nom');
        dd($request);
        return $this->render('my_new/index.html.twig', [
            'myName' => $name
        ]);
    }

    /**
     * @Route("/cv/{nom}/{prenom}/{age}/{section}", name="cv")
     */
    public function cvAction($nom,$prenom,$age,$section) {
        return $this->render('cv/cv.html.twig',[
            'name' => $nom,
            'firstname' => $prenom,
            'age' => $age,
            'section' => $section,
        ]);
    }
}
