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
        // Récupérer le Repository
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->findAll();
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/add/{name}/{firstname}/{age}", name="personne.add")
     */
    public function addPersonne($name, $firstname, $age) {
        // Nous permet de récupérer Doctrine
        $doctrine = $this->getDoctrine();
        // Nous permet de récupérer le manager
        $manager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setFirstname($firstname);
        $personne->setName($name);
        $personne->setAge($age);
        // Ajoute l'objet personne à la transaction
        $manager->persist($personne);
        //Execute la transaction
        $manager->flush();
        return $this->redirectToRoute('personne.list');
    }

    /**
     * @Route("/detail/{id}", name="personne.detail")
     */
    public function findPersonneById($id) {
        // Je récupére le répo
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        /*
         * Je vais aller chercher la personne avec la méthode find
         *
         * Si elle existe je l'envoi vers la page d'affichage des détails d'une personne
         * Sinon je crée un flash d'erreur et je le renvoi vers la liste
         * */
        $personne = $repository->find($id);
        if ($personne) {
            return $this->render('personne/detail.html.twig', ['personne' => $personne]);
        } else {
            $this->addFlash('error', 'Personne innexistante');
            return $this->redirectToRoute('personne.list');
        }
    }

    /**
     * @Route("/delete/{id}", name="personne.delete")
     */
    public function deletePersonne($id) {
        /*
         * Chercher la personne d'id $id
         * s'il elle existe je la supprime avec la methode remove
         *
         * Sinon j'affiche un message d'erreur
         * Et dans les deux cas j'affiche la liste des personnes
         * */
    }
}
