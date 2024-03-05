<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Basic',
                'duration' => '24:00:00',
                'price' => 2.99
            ],
            [
                'name' => 'Premium',
                'duration' => '72:00:00',
                'price' => 5.99
            ],
            [
                'name' => 'Elite',
                'duration' => '144:00:00',
                'price' => 9.99
            ],
        ];

        foreach($sponsors as $sponsor) {
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsor['name'];
            $newSponsor->duration = $sponsor['duration'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->save();
        }
    }
}
