<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/", name="personne.list")
     */
    public function index()
    {
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }

    /**
     * @Route("/add", name="personne.add")
     */
    public function addPersonne() {
        // Nous permet de récupérer Doctrine
        $doctrine = $this->getDoctrine();
        // Nous permet de récupérer le manager
        $manager = $doctrine->getManager();

        $personne = new Personne();
        $personne->setFirstname('Richie');
        $personne->setName('Tamoufe');
        $personne->setAge(22);


        // Ajoute l'objet personne à la transaction
        $manager->persist($personne);
        $manager->persist($personne2);
        $manager->persist($personne3);

        //Execute la transaction
        $manager->flush();
        return new Response('<body><h1>Ajouté avec succès</h1></body>');
    }
}
