<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            'nom'=>'Berhili',
            'prenom'=>'Ayoub',
            'adresse'=>'Oujda,Maroc',
            'email'=>'ayoubberhili@gmail.com',
            'telephone'=>'0661234567',
            'password'=>Hash::make('ayoub')
        ]);
    }
}
