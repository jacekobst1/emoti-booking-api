<?php

declare(strict_types=1);

namespace Tests\Unit\Auth\Domain\Services;

use App\Modules\Auth\Domain\Contracts\DataTransferObjects\UserDto;
use App\Modules\Auth\Domain\Models\User;
use App\Modules\Auth\Domain\Services\AuthService;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

final class AuthServiceTest extends TestCase
{
    public function testGetLoggedUserId(): void
    {
        $id = Str::uuid();

        // mock
        $this->instance(
            AuthManager::class,
            Mockery::mock(AuthManager::class, function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('id')
                    ->once()
                    ->andReturn($id);
            })
        );

        // given
        $authService = $this->app->make(AuthService::class);

        // when
        $result = $authService->getLoggedUserId();

        // then
        $this->assertTrue(
            $id->equals($result)
        );
    }

    public function testGetLoggedUser(): void
    {
        $user = User::factory()->create();

        // mock
        $this->instance(
            AuthManager::class,
            Mockery::mock(AuthManager::class, function (MockInterface $mock) use ($user) {
                $mock->shouldReceive('user')
                    ->once()
                    ->andReturn($user);
            })
        );

        // given
        $authService = $this->app->make(AuthService::class);

        // when
        $result = $authService->getLoggedUser();

        // then
        $this->assertTrue(
            (array)UserDto::fromUserModel($user) === (array)$result
        );
    }
}
