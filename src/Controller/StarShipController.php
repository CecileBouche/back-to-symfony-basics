<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarShipController extends AbstractController
{
    #[Route('/starships/{id<\d+>}', name: 'app_starship_read')]
    public function show(int $id, StarshipRepository $repository): Response
    {
        $starShips = $repository->findAll();
        $starship = $repository->findById($id);
        if (!$starship) {
            throw $this->createNotFoundException('Starship not found !');
        }
        return $this->render('starship/show.html.twig', [
            'ships' => $starShips,
            'ship' => $starship,
        ]);
    }
}
