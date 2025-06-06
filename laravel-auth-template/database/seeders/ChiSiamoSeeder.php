<?php

namespace Database\Seeders;
use App\Models\ChiSiamo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ChiSiamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 1; $i++){
            $newChiSiamo = new ChiSiamo();
            $newChiSiamo->title = $faker->realText(20);
            $newChiSiamo->description = $faker->realText(300);
            $newChiSiamo->image_path = $faker->imageUrl(400,250,'chisiamo');
            $newChiSiamo->save(); // Salva il nuovo record nel database
        }

    }
}
