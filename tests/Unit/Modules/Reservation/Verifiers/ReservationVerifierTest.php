<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Reservation\Verifiers;

use App\Http\Exceptions\ConflictException;
use App\Modules\Reservation\Verifiers\ReservationVerifier;
use App\Modules\Vacant\Vacant;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

final class ReservationVerifierTest extends TestCase
{
    /**
     * @throws ConflictException
     * @throws Exception
     */
    public function testHappyPath(): void
    {
        // given
        $verifier = new ReservationVerifier();

        $vacant1 = $this->createMock(Vacant::class);
        $vacant1->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(true);

        $vacant2 = $this->createMock(Vacant::class);
        $vacant2->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(true);

        $vacant3 = $this->createMock(Vacant::class);
        $vacant3->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(true);

        $vacancies = collect([
            $vacant1,
            $vacant2,
            $vacant3,
        ]);

        // when
        $verifier->verifyReservationCanBeMade($vacancies, ['2022-01-01', '2022-01-02', '2022-01-03']);

        // then
        // no exception was thrown
    }

    /**
     * @throws ConflictException
     * @throws Exception
     */
    public function testNotEnoughVacancies(): void
    {
        // then
        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage('Not on all dates the facility works');

        // given
        $verifier = new ReservationVerifier();

        $vacant1 = $this->createMock(Vacant::class);
        $vacant2 = $this->createMock(Vacant::class);

        $vacancies = collect([
            $vacant1,
            $vacant2,
        ]);

        // when
        $verifier->verifyReservationCanBeMade($vacancies, ['2022-01-01', '2022-01-02', '2022-01-03']);
    }

    /**
     * @throws ConflictException
     * @throws Exception
     */
    public function testNotEnoughBeds(): void
    {
        // then
        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage("Some dates don't has beds available");

        // given
        $verifier = new ReservationVerifier();

        $vacant1 = $this->createMock(Vacant::class);
        $vacant1->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(true);

        $vacant2 = $this->createMock(Vacant::class);
        $vacant2->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(true);

        $vacant3 = $this->createMock(Vacant::class);
        $vacant3->expects($this->once())
            ->method('bedsAreAvailable')
            ->willReturn(false);

        $vacancies = collect([
            $vacant1,
            $vacant2,
            $vacant3,
        ]);

        // when
        $verifier->verifyReservationCanBeMade($vacancies, ['2022-01-01', '2022-01-02', '2022-01-03']);
    }
}
