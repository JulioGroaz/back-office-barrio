<?php

namespace Database\Seeders;

use App\Models\Eventi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class EventiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 5; $i++) {
            $newEvent = new Eventi();
            $newEvent->title = $faker->realText(20);
            $newEvent->event_date_time = $faker->dateTime;
            $newEvent->description = $faker->realText(60);
            $newEvent->image_path = $faker->imageUrl(400,250,'menues');
            $newEvent->save(); // Salva il nuovo record nel database
        }
    }
}
