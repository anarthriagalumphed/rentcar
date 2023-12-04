<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('users')->insert([

            'username' => 'palawa',
            'email' => 'admin@palawa.com',
            'password' => '$2y$10$/kiA4yA5KZNZ3KvPl9hpoO1Gici4J/ekWt0kTUBfFxMCHn2jYeLpq',
            'role_id' => '1'   
        ]);
    }
}
