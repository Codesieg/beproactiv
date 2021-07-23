<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterielsRepository;
use App\Repository\MetiersRepository;
use App\Repository\TypesRepository;
use App\Entity\Materiels;
/**
     * @Route("/", name="materiels_")
     */
class MaterielsController extends AbstractController
{
    /**
     * @Route("", name="browse", methods={"GET"})
     */
    public function browse(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
        $materiels = $materielsRepository->findAllWithType();
        $marques = $materielsRepository->findAllWithType();
    //    dd($materiels);
        $types = $typesRepository->findAll();
        // dd($types);
        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
            'marques' => $marques,
        ]);
    }

        /**
     * @Route("/read", name="read", methods={"POST"})
     */
    public function read(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
        $famille = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
        $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
        dump($famille, $marque);
        $materiels = $materielsRepository->findAllWithTypeId($famille, $marque);

        $types = $typesRepository->findAll();
        $marques = $materielsRepository->findAllWithType();

        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
            'marques' => $marques,
        ]);
    }
}
