<?php


namespace App\Controller;


use App\Form\ExempleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/form", name="test.form")
     */
    public function showFirstForm(Request $request) {
        //Création du formulaire
        $form = $this->createForm(ExempleType::class);
        // Requete en GET => afficher la page
        // Requete en POST => Gérer le formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
           dd($form->getData());
        } else {
            return $this->render('test/form.html.twig',[
                'form' => $form->createView()
            ]);
        }
    }
}