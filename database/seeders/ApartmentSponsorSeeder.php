<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments = Apartment::all();
        $sponsorsIds = Sponsor::all()->pluck('id');

        foreach ($apartments as $apartment) {
            $apartment->sponsors()->syncWithPivotValues($faker->randomElements( $sponsorsIds, rand(1,3), false ), ['expiry_date' => $faker->dateTime()]);
        }

    }
}
