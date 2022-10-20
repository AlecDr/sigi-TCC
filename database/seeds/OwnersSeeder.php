<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnersSeeder extends Seeder
{
   
  
  
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::create([
            'name' => 'teste',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
