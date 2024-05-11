<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Reservation\Services;

use App\Modules\Reservation\Services\ReservationPriceCalculator;
use Illuminate\Support\Collection;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

final class ReservationPriceCalculatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testPriceCalculation(): void
    {
        // given
        $reservationPriceCalculator = new ReservationPriceCalculator();

        $vacantCollection = $this->createMock(Collection::class);
        $vacantCollection->expects($this->once())
            ->method('sum')
            ->willReturn(1200);

        // when
        $result = $reservationPriceCalculator->calculatePrice($vacantCollection);

        // then
        $this->assertSame(1200, $result);
    }
}
