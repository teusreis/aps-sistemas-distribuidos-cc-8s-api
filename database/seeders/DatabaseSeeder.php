<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Category::insert([
            ['name' => 'Arroz'],
            ['name' => 'Feijão'],
            ['name' => 'Macarrão'],
            ['name' => 'Açúcar'],
            ['name' => 'Sal'],
            ['name' => 'Farinha'],
            ['name' => 'Óleo de cozinha']
        ]);

        // $users = User::factory(10)->create([
        //     'type' => 'doador',
        //     'password' => Hash::make('password')
        // ]);

        // foreach ($users as $user) {
        //     Donation::factory(20)->create([
        //         'user_id' => $user->id
        //     ]);
        // }

        User::factory(1)->create([
            'name' => 'Eu mesmo',
            'type' => 'adm',
            'cpf' => '666',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
    }
}
