<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User1',
            'username' => 'UsernameAdmin',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
