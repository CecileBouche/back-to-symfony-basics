<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships', name: 'api_starship')]
class StarshipApiController extends AbstractController
{
    #[Route('/', name: '_collection', methods: ['GET'])]
    public function getCollection(StarshipRepository $repository): Response
    {
        $starships = $repository->findAll();

        return $this->json($starships);
    }

    #[Route('/{id<\d+>}', name: '_item', methods: ['GET'])]
    public function getItem(int $id, StarshipRepository $repository): Response
    {
        $starship = $repository->findById($id);
        if (!$starship) {
            throw $this->createNotFoundException();
        }
        return $this->json($starship);
    }
}
