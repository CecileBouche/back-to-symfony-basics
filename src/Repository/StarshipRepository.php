<?php

namespace App\Repository;

use App\Model\Starship;
use App\Model\StarShipStatusEnum;
use Psr\Log\LoggerInterface;

readonly class StarshipRepository
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAll(): array
    {
        $this->logger->info('Fetching starships');

        return [
            new Starship(
                1,
                'USS LeafyCruiser (NCC-0001)',
                'Garden',
                'Jean-Luc Pickles',
                StarShipStatusEnum::COMPLETED,
                new \DateTimeImmutable('2026-03-01'),
            ),
            new Starship(
                2,
                'USS Espresso (NCC-1234-C)',
                'Latte',
                'James T. Quick!',
                StarShipStatusEnum::IN_PROGRESS,
                new \DateTimeImmutable('2025-12-25'),
            ),
            new Starship(
                3,
                'USS Wanderlust (NCC-2024-W)',
                'Delta Tourist',
                'Kathryn Journeyway',
                StarShipStatusEnum::WAITING,
                new \DateTimeImmutable('2024-06-25'),
            ),
        ];
    }

    public function findById(int $id): ?Starship
    {
        $ships = $this->findAll();
        foreach ($ships as $ship) {
            if ($ship->getId() === $id) {
                return $ship;
            }
        }
        return null;
    }
}
