<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\User\Resources\LoggedUserResource;
use App\Modules\User\Services\UserGetter;
use App\Shared\Response\JsonResp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLoggedUser(Request $request, UserGetter $getter): JsonResponse
    {
        $loggedUser = $getter->getLoggedUser($request);

        return JsonResp::success(
            new LoggedUserResource($loggedUser)
        );
    }
}
