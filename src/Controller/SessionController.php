<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(Request $request)
    {
        $session = $request->getSession();
        if($session->has('nbVisite')) {
            $nbVisite = $session->get('nbVisite');
            $nbVisite++;
            $session->set('nbVisite', $nbVisite);
        } else {
            $nbVisite = 1;
            $session->set('nbVisite', 1);
            $this->addFlash('bienvenu', "C'est votre première visite. Merci de nous faire confiance");
        }
        $session->set('message', "Merci pour votre fidélité c'est votre ${nbVisite} visite");
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
