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

    /**
     * @Route("/todo/add/{title}/{content}", name="todo.add")
     */
    public function addTodo($title, $content, Request $request) {
        /*
         * 1- Vérifier l'existance de la session
         *    Si non Je vais déclencher un message d'erreur
         *    Si oui
         *      2- Je vérifie si la clé du todo existe ou pas
         *          Si existe Je vais déclencher un message d'erreur
         *          Si non
         *              Ajoute le todo
         *              Créer un message de succés
         * 3- je redirige vers l'index
         */
        $session = $request->getSession();
        if (! $session->has('mesTodos')) {
            $this->addFlash('error', "Session non encore initialisée");
        } else {
            $todos = $session->get('mesTodos');
            if (isset($todos[$title])) {
                $this->addFlash('error', "le todo de clé $title existe déjà :(");
            } else  {
                $todos[$title] = $content;
                $session->set('mesTodos', $todos);
                $this->addFlash('success', "Le todo $title a été ajouté avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/todo/update/{title}/{content}", name="todo.update")
     */
    public function updateTodo($title, $content, Request $request) {
        /*
         * 1- Vérifier l'existance de la session
         *    Si non Je vais déclencher un message d'erreur
         *    Si oui
         *      2- Je vérifie si la clé du todo existe ou pas
         *          Si n'existe pas Je vais déclencher un message d'erreur
         *          Si existe
         *              Modifier le todo
         *              Créer un message de succés
         * 3- je redirige vers l'index
         */
        $session = $request->getSession();
        if (! $session->has('mesTodos')) {
            $this->addFlash('error', "Session non encore initialisée");
        } else {
            $todos = $session->get('mesTodos');
            if (! isset($todos[$title])) {
                $this->addFlash('error', "le todo de clé $title n'existe pas, je ne peux pas le modifier :(");
            } else  {
                $todos[$title] = $content;
                $session->set('mesTodos', $todos);
                $this->addFlash('success', "Le todo $title a été modifié avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/todo/delete/{title}", name="todo.delete")
     */
    public function deleteTodo($title, Request $request) {
        /*
         * 1- Vérifier l'existance de la session
         *    Si non Je vais déclencher un message d'erreur
         *    Si oui
         *      2- Je vérifie si la clé du todo existe ou pas
         *          Si n'existe pas Je vais déclencher un message d'erreur
         *          Si existe
         *              Supprimer le todo
         *              Créer un message de succés
         * 3- je redirige vers l'index
         */
        $session = $request->getSession();
        if (! $session->has('mesTodos')) {
            $this->addFlash('error', "Session non encore initialisée");
        } else {
            $todos = $session->get('mesTodos');
            if (! isset($todos[$title])) {
                $this->addFlash('error', "le todo de clé $title n'existe pas je ne peux donc pas le supprimer :(");
            } else  {
                unset($todos[$title]);
                $session->set('mesTodos', $todos);
                $this->addFlash('success', "Le todo $title a été supprimé avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }

}
