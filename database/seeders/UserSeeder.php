<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $newUser = new User();
        $newUser->name = 'admin';
        $newUser->surname = 'ADMIN';
        $newUser->email = 'admin@a';
        $newUser->password = Hash::make('1');
        $newUser->birth_date = $faker->date();
        $newUser->save();

        for($i = 0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->firstName();
            $newUser->surname = $faker->lastName();
            $newUser->email = $faker->email();
            $newUser->password = Hash::make('12345678');
            $newUser->birth_date = $faker->date();
            $newUser->save();
        }
    }
}
