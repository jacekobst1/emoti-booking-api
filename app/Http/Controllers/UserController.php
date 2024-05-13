<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Auth\Application\Http\Resources\LoggedUserResource;
use App\Modules\Auth\Domain\Contracts\AuthServiceInterface;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function getLoggedUser(AuthServiceInterface $authService): JsonResponse
    {
        $loggedUser = $authService->getLoggedUser();

        return JsonResp::success(
            new LoggedUserResource($loggedUser)
        );
    }
}
