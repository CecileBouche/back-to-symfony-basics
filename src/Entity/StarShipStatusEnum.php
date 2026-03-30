<?php

namespace App\Entity;

enum StarShipStatusEnum: string
{
    case WAITING = 'waiting';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';
}
