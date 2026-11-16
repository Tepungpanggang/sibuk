<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shelf;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Str::random(12);

        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Perpustakaan',
                'email' => 'admin@sibuk.sch.id',
                'password' => $password,
                'role' => 'admin',
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info("Password admin: {$password}");
        }

        foreach (['Fiksi', 'Sejarah', 'Sastra', 'Sains', 'Teknologi'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        foreach (['A1', 'A2', 'B1', 'B2', 'C1'] as $code) {
            Shelf::firstOrCreate(['code' => $code], ['location' => 'Rak ' . $code]);
        }
    }
}