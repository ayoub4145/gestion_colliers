<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivreurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('livreurs')->insert([
            'nom'=>'Glovo',
            'prenom'=>'glovo',
            'adresse'=>'Paris,France',
            'email'=>'glovo@gmail.com',
            'password'=>bcrypt('glovo'),
            'telephone'=>'123456789',
        ]);
    }
}
