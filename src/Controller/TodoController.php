<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function index(Request $request)
    {
        /*
         * Récupérer la session
         * Vérifier si ma session contient le tableau de todos
         *      Si ca n'existe pas
         *          Initialiser mon tableau et le mettre dans la session
         *
         * Afficher la liste des todos
         * */
        //Récupérer la session
        $session = $request->getSession();
        //Vérifier si ma session contient le tableau de todos
        //      Si ca n'existe pas
        if (! $session->has('mesTodos')) {
            //Initialiser mon tableau et le mettre dans la session
            $todos = array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            );
            $session->set('mesTodos', $todos);
            $this->addFlash('info', "La liste des todos a été initialisée avec succès");
        }
        return $this->render('todo/index.html.twig');
    }
}
