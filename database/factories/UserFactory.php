<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;



   
$factory->define(App\User::class, function (Faker $faker){
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    
});
   

