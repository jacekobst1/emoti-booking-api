<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Modules\Auth\Domain\Models\User;
use App\Modules\Auth\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(RoleEnum::User);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(RoleEnum::Admin);
    }
}
