<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterielsRepository;
use App\Repository\MetiersRepository;
use App\Repository\TypesRepository;

/**
     * @Route("/", name="materiels_")
     */
class MaterielsController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
        $materiels = $materielsRepository->findAll();
    //    dump($materiels);
        $types = $typesRepository->findAll();
        dd($types);
        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
        ]);
    }
}
