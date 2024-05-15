<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Modules\Auth\Domain\Models\Role;
use App\Modules\Auth\Enums\RoleEnum;
use Illuminate\Database\Seeder;

final class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Role::createOrFirst(['name' => RoleEnum::Admin->value]);
        Role::createOrFirst(['name' => RoleEnum::User->value]);
    }
}
