<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Contracts;

use App\Modules\Reservation\Domain\Services\SlotsFinder\SlotsFinderInterface;
use Ramsey\Uuid\UuidInterface;

interface SlotsFinderFactoryInterface
{
    public function make(?UuidInterface $assetId): SlotsFinderInterface;
}
