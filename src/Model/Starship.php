<?php

namespace App\Model;

class Starship
{
    public function __construct(
        private int $id,
        private readonly string $name,
        private readonly string $class,
        private readonly string $captain,
        private readonly StarShipStatusEnum $status,
        private readonly \DateTimeImmutable $arrivedAt,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getCaptain(): string
    {
        return $this->captain;
    }

    public function getStatus(): StarShipStatusEnum
    {
        return $this->status;
    }

    public function getStatusString(): string
    {
        return $this->status->value;
    }

    public function getArrivedAt(): \DateTimeImmutable
    {
        return $this->arrivedAt;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getStatusImageFilename(): string
    {
        return match ($this->status) {
            StarShipStatusEnum::WAITING => 'images/status-waiting.png',
            StarShipStatusEnum::IN_PROGRESS => 'images/status-in-progress.png',
            StarShipStatusEnum::COMPLETED => 'images/status-complete.png',
        };
    }
}
