<?php

namespace App\Controller;

use App\Repository\MaterielsRepository;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(MaterielsRepository $materielsRepository, TypesRepository $typesRepository): Response
    {
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        $materiels = $materielsRepository->search($search);
        $famille = filter_input(INPUT_POST, 'famille', FILTER_SANITIZE_SPECIAL_CHARS);
        $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if ($materiels == null) {
            return $this->redirectToRoute('materiels_browse');
        }
        $marques = $materielsRepository->findAllWithType();
        $types = $typesRepository->findAll();


        return $this->render('base.html.twig', [
            'materiels' => $materiels,
            'types' => $types,
            'marques' => $marques,
            'familleChoisi' => $famille,
            'marqueChoisi' => $marque,
            'search' => $search
        ]);
    }
}
