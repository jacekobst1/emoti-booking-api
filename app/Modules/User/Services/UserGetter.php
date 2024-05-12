<?php

declare(strict_types=1);

namespace App\Modules\User\Services;

use App\Models\User;
use Illuminate\Http\Request;

final class UserGetter
{
    public function getLoggedUser(Request $request): User
    {
        return $request->user();
    }
}
