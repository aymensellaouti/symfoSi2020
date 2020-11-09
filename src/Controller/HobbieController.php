<?php

namespace App\Controller;

use App\Entity\Hobbie;
use App\Form\HobbieType;
use App\Repository\HobbieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hobbie")
 */
class HobbieController extends AbstractController
{
    /**
     * @Route("/", name="hobbie_index", methods={"GET"})
     */
    public function index(HobbieRepository $hobbieRepository): Response
    {
        return $this->render('hobbie/index.html.twig', [
            'hobbies' => $hobbieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hobbie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hobbie = new Hobbie();
        $form = $this->createForm(HobbieType::class, $hobbie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hobbie);
            $entityManager->flush();

            return $this->redirectToRoute('hobbie_index');
        }

        return $this->render('hobbie/new.html.twig', [
            'hobbie' => $hobbie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hobbie_show", methods={"GET"})
     */
    public function show(Hobbie $hobbie): Response
    {
        return $this->render('hobbie/show.html.twig', [
            'hobbie' => $hobbie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hobbie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hobbie $hobbie): Response
    {
        $form = $this->createForm(HobbieType::class, $hobbie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hobbie_index');
        }

        return $this->render('hobbie/edit.html.twig', [
            'hobbie' => $hobbie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hobbie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hobbie $hobbie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hobbie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hobbie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hobbie_index');
    }
}
