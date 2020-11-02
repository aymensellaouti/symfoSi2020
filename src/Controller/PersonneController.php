<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/findCriteria/{page?1}", name="personne.list.criteria")
     */
    public function personnesWithCriteria($page)
    {
        // Récupérer le Repository
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->findBy(
            [],
            ['age'=>'desc'],
            3,               /*1 2 3 4 5 */
            ($page - 1) * 3 /*0 3 6 9 12 */
        );
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/add1/{name}/{firstname}/{age}", name="personne.add1")
     */
    public function addPersonne1($name, $firstname, $age) {
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
     * @Route("/update/{id}/{name}/{firstname}/{age}", name="personne.update")
     */
    public function updatePersonne1($name, $firstname, $age, Personne $personne = null) {
        if (!$personne) {
            $this->addFlash('error', 'Personne innexistante');
            return $this->redirectToRoute('personne.list');
        }
        // Nous permet de récupérer Doctrine
        $doctrine = $this->getDoctrine();
        // Nous permet de récupérer le manager
        $manager = $doctrine->getManager();
        //$personne = new Personne();
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
    public function deletePersonne(Personne $personne = null) {
        /*
         * Chercher la personne d'id $id
         * s'il elle existe je la supprime avec la methode remove
         *
         * Sinon j'affiche un message d'erreur
         * Et dans les deux cas j'affiche la liste des personnes
         * */

        if ($personne) {
           $manager = $this->getDoctrine()->getManager();
           $manager->remove($personne);
           $manager->flush();
        } else {
            $this->addFlash('error', 'Personne innexistante');
        }
        return $this->redirectToRoute('personne.list');
    }

    /**
     * @Route("/age/{min?0}/{max?0}",name="personne.find.age")
     */
    public function getPersonneByAge($min, $max) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->getPersonnesByIntervalAge($min,$max);
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/avgage/{min?0}/{max?0}",name="personne.find.avgage")
     */
    public function getAvgPersonneByAge($min, $max) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $stats = $repository->getAvgAgePersonnesByIntervalAge($min,$max);
        dd($stats);
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    //Legal Secretary

    /**
     * @Route("/job/{min?0}/{max?0}/{jobname}",name="personne.find.job")
     */
    public function getAvgPersonneByAgeAndJobName($min, $max, $jobname) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->getPersonnesByJobIntervalAge(0,0,$jobname);
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/edit/{id?0}", name="personne.edit")
     */
    public function addPersonne(
        Personne $personne = null
    ) {
        if(!$personne)
            $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->remove('createdAt');
        $form->remove('updatedAt');
        $form->remove('pieceIdentite');
        return $this->render('personne/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
