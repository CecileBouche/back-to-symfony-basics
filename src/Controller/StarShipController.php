<?php

namespace App\Controller;

use App\Entity\Starship;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarShipController extends AbstractController
{
    #[Route('/starships/{slug}', name: 'app_starship_read')]
    public function show(
        #[MapEntity(mapping: ['slug' => 'slug'])]
        Starship $starship,
    ): Response {
        return $this->render('starship/show.html.twig', [
            'ship' => $starship,
        ]);
    }
}
