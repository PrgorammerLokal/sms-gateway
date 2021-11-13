<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Achmad Fawait',
                'email' => 'fawait626@gmail.com',
                'password' => Hash::make('123456'),
            ]
        );
    }
}
