<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'La Baia dei Naviganti',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/miso/Hosting-5214836/original/8485d9eb-c498-4657-b2e1-ce98801a331b.jpeg?im_w=1200',
                'is_visible' => true,
                'address' => 'Via dei Sogni Lucidi',
                'longitude' => 45.464444,
                'latitude' => 9.191389,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Villa di lusso in campagna L\'Olearia in Costiera Amalfitana',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/miso/Hosting-49878900/original/523f5c65-aa83-4858-bf8d-3b63e964b4a3.jpeg?im_w=1200',
                'is_visible' => true,
                'address' => 'Vicolo del Gatto Nero',
                'longitude' => 45.468194,
                'latitude' => 9.189333,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Amore • Attico FronteMare FCO',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/4805734c-abe7-43c0-8bd8-e498bcbd041a.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Largo della Fantasia',
                'longitude' => 45.465472,
                'latitude' => 9.184167,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Villa Mimosa - villa sul mare con piscina',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-1017304321459143064/original/0b4754b5-4439-423b-add3-1a5137bce9f4.jpeg?im_w=1200',
                'is_visible' => true,
                'address' => 'Via dei Fiori di Luna',
                'longitude' => 45.465472,
                'latitude' => 9.184167,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Villa dei Lecci - Villa con piscina privata',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/a12fdb3e-bc13-436b-81d2-7cd895c400fd.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Vicolo del Tempo Perduto',
                'longitude' => 45.469722,
                'latitude' => 9.184722,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Silene',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-22137397/original/1ed20167-7fe4-4d09-a1ef-5f699d5b32b6.jpeg?im_w=1200',
                'is_visible' => true,
                'address' => 'Salita delle Stelle Cadenti',
                'longitude' => 45.463889,
                'latitude' => 9.180278,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Incredibili viste sul mare e sulle isole',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/bd092a9f-08d9-4877-9d8e-2873473154c5.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Via del Sorriso Nascosto',
                'longitude' => 45.481444,
                'latitude' => 9.191111,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Bella Vista Beachfront Condo',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/a0af6720-3214-4f0b-a6a6-cbc62a185950.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Vicolo del Mistero',
                'longitude' => 45.467333,
                'latitude' => 9.188333,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Così Com\'è, camera “Elba” con bagno privato!',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/2375f793-615c-46bf-ba61-938bf71f9964.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Largo dell\'Abbraccio Infinito',
                'longitude' => 45.485278,
                'latitude' => 9.174167,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Rilassati, divertiti, il mare è il tuo cortile',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/2d2a9515-302a-4e20-aea7-2215edc79371.jpg?im_w=1200',
                'is_visible' => true,
                'address' => 'Via della Speranza Eterna',
                'longitude' => 45.469167,
                'latitude' => 9.191944,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Monolocale con vista sul Burj Khalifa dal balcone',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/miso/Hosting-721540609203378406/original/9dfaf7d6-40f2-4673-b468-7c5ab3147f86.jpeg?im_w=1440',
                'is_visible' => true,
                'address' => 'Vicolo dei Pensieri Nascosti',
                'longitude' => 45.482222,
                'latitude' => 9.1875,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'City Treasure on 13th',
                'description' => 'Una casa accogliente, baciata dalla luce del sole, abbracciata da un giardino rigoglioso. Le sue pareti emanano calore familiare, mentre le finestre si aprono verso paesaggi incantevoli. Un rifugio di serenità e conforto, dove ogni dettaglio racconta storie di vita e amore.',
                'room_number' => rand(1, 5),
                'bed_number' => rand(1, 6),
                'toilet_number' => rand(1, 3),
                'square_meters' => rand(30, 6000),
                'img_url' => 'https://a0.muscache.com/im/pictures/miso/Hosting-855265289472667062/original/99f4d83b-7de8-467a-be43-4a5ddd184b24.jpeg?im_w=1200',
                'is_visible' => true,
                'address' => 'Salita della Serenità Ritrovata',
                'longitude' => 45.497222,
                'latitude' => 9.166111,
            ]
        ];

        $userIds = User::all()->pluck('id');
        $categoryIds = Category::all()->pluck('id');

        foreach ($apartments as $apartment) {
            $apartment['user_id'] = $faker->randomElement($userIds);
            $apartment['category_id'] = $faker->randomElement($categoryIds);
            Apartment::create($apartment);
        }
    }
}
