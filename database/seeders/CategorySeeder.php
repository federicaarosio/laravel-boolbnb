<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
          array  (
               'name' => 'Spazi accesibili',
               'img_url'=>'https://a0.muscache.com/pictures/e22b0816-f0f3-42a0-a5db-e0f1fa93292b.jpg'
          ),
          array  (
              'name' => 'Dimore Storiche',
              'img_url'=>'https://a0.muscache.com/pictures/33dd714a-7b4a-4654-aaf0-f58ea887a688.jpg'
          ),
           array  (
              'name' => 'Tropicali',
              'img_url'=>'https://a0.muscache.com/pictures/ee9e2a40-ffac-4db9-9080-b351efc3cfc4.jpg'
           ),
           array  (
              'name' => 'Fienili',
              'img_url'=>'https://a0.muscache.com/pictures/f60700bc-8ab5-424c-912b-6ef17abc479a.jpg'
           ),
           array  (
              'name' => 'Città Popolari',
              'img_url'=>'https://a0.muscache.com/pictures/ed8b9e47-609b-44c2-9768-33e6a22eccb2.jpg'
           ),
           array  (
              'name' => 'Minicase',
              'img_url'=>'https://a0.muscache.com/pictures/3271df99-f071-4ecf-9128-eb2d2b1f50f0.jpg'
           ),
           array   (
              'name' => 'Camper',
              'img_url'=>'https://a0.muscache.com/pictures/31c1d523-cc46-45b3-957a-da76c30c85f9.jpg'
           ),
           array  (
              'name' => 'Ryokan',
              'img_url'=>'https://a0.muscache.com/pictures/827c5623-d182-474a-823c-db3894490896.jpg'
           ),
           array   (
              'name' => 'Minsu',
              'img_url'=>'https://a0.muscache.com/pictures/48b55f09-f51c-4ff5-b2c6-7f6bd4d1e049.jpg'
           ),
           array   (
              'name' => 'Casas particulares',
              'img_url'=>'https://a0.muscache.com/pictures/251c0635-cc91-4ef7-bb13-1084d5229446.jpg'
           ),
        );

        foreach ($categories as $category ){
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->img_url = $category['img_url'];
            $newCategory->save();
        }
    }
}
