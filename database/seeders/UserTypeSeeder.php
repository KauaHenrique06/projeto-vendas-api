<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Cria os dois valores na hora que executar o comando php artisan migrate
         */
        UserType::updateOrCreate(['type' => 'admin']);
        UserType::updateOrCreate(['type' => 'user']);
    }
}
