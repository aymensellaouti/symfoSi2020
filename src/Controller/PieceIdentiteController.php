<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\PieceIdentite;
use App\Form\PieceIdentiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PieceIdentiteController
 * @package App\Controller
 * @Route("/pieceidentite")
 */
class PieceIdentiteController extends AbstractController
{
    /**
     * @Route("/pieceidentite", name="piece_identite")
     */
    public function index()
    {
        return $this->render('piece_identite/index.html.twig', [
            'controller_name' => 'PieceIdentiteController',
        ]);
    }

    /**
     * @Route("/{personne}/{id?0}", name="piece_identite.edit")
     */
    public function editPieceIdentite(
        Personne $personne = null,
        $id,
        Request $request
    )
    {
        // Je vérifie si on a la personne
        if (!$personne) {
            //Si la personne n'existe pas on la redirige vers la liste des personnes
            return $this->redirectToRoute('personne.list');
        } else {
            // Si la personne existe

            //On vérifie est ce qu'on va ajouter ou éditer la personne
            // Si on a un id donc vérifie que l'objet Pi de cet id existe et la on va faire une maj
            if ($id) {
                //On cherche la pi de cet id
                $repository = $this->getDoctrine()->getRepository(PieceIdentite::class);
                $pi = $repository->find($id);
                // Si elle n'existe pas on crée un objet vide
                if (!$pi) {
                    $pi = new PieceIdentite();
                }
            } else {
                //Si on va faire une mise a jour on crée un objet vide
                $pi = new PieceIdentite();
            }
            //On crée le form
            $form = $this->createForm(PieceIdentiteType::class, $pi);
            $form->remove('updatedAt');
            $form->remove('createdAt');
            $form->remove('personne');
            $form->handleRequest($request);
            // Si c'est un post c'est une mise à jour ou un ajout on le fait au niveau
            // de la bd et on redirige vers le profil de la personne
            if ($form->isSubmitted()) {
                $pi->setPersonne($personne);
                $em = $this->getDoctrine()->getManager();
                $em->persist($pi);
                $em->flush();
                return $this->redirectToRoute('personne.detail', [
                    'id' => $personne->getId()
                ]);
            } else {
                // On veut juste afficher le formulaire
                return $this->render('piece_identite/edit.html.twig', [
                    'form' => $form->createView()
                ]);
            }
        }
    }

}
