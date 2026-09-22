<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PermissionSeeder::class);

        $admin = User::factory()->firstOrCreate(
            ['email' => env('CODIR_ADMIN_EMAIL', 'admin@codir.local')],
            ['nom' => 'ADMIN', 'prenoms' => 'CODIR', 'password' => env('CODIR_ADMIN_PASSWORD', 'ChangeMe!123')]
        );
        $admin->assignRole('admin');

        $member = User::factory()->firstOrCreate(
            ['email' => env('CODIR_MEMBER_EMAIL', 'membre@codir.local')],
            ['nom' => 'MEMBRE', 'prenoms' => 'CODIR', 'password' => env('CODIR_MEMBER_PASSWORD', 'ChangeMe!123')]
        );
        $member->assignRole('membre_codir');
    }
}
