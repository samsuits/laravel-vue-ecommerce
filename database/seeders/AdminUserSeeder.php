<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Mike',
            'email' => 'mike.purifoy@teleworm.us',
            'password' => bcrypt('Oongies9mee'),
            'email_verified_at' => now(),
            'is_admin' => true
        ]);
    }
}
