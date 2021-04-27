<?php

namespace App\Controller;

use App\Entity\Carro;
use App\Form\Carro1Type;
use App\Repository\CarroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carro')]
class CarroController extends AbstractController
{
    #[Route('/', name: 'carro_index', methods: ['GET'])]
    public function index(CarroRepository $carroRepository): Response
    {
        return $this->render('carro/index.html.twig', [
            'carros' => $carroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'carro_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $carro = new Carro();
        $form = $this->createForm(Carro1Type::class, $carro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carro);
            $entityManager->flush();

            return $this->redirectToRoute('carro_index');
        }

        return $this->render('carro/new.html.twig', [
            'carro' => $carro,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'carro_show', methods: ['GET'])]
    public function show(Carro $carro): Response
    {
        return $this->render('carro/show.html.twig', [
            'carro' => $carro,
        ]);
    }

    #[Route('/{id}/edit', name: 'carro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carro $carro): Response
    {
        $form = $this->createForm(Carro1Type::class, $carro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carro_index');
        }

        return $this->render('carro/edit.html.twig', [
            'carro' => $carro,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'carro_delete', methods: ['POST'])]
    public function delete(Request $request, Carro $carro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carro_index');
    }
}
