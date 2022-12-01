<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Form;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(5)->create();

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'Admin',
            'active' => true
        ]);
        User::create([
            'name' => 'Organisasi',
            'username' => 'Organisasi',
            'email' => 'organisasi@gmail.com',
            'password' => bcrypt('organisasi'),
            'role' => 'Organisasi',
            'active' => true
        ]);
        User::create([
            'name' => 'Mahasiswa',
            'username' => 'Mahasiswa',
            'email' => 'Mahasiswa@gmail.com',
            'password' => bcrypt('mahasiswa'),
            'role' => 'Mahasiswa',
            'active' => true
        ]);


        // Post::factory(7)->create();
        // Form::factory(21)->create();
    }
}
