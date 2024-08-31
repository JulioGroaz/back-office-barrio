<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $categories = [
            'caffetteria',
            'aperitivi',
            'vini_bianchi',
            'vini_rossi',
            'vini_rose',
            'vini_bollicine',
            'cocktail',
            'superalcolici',
            'food'
        ];

        for ($i = 0; $i < 20; $i++) {
            $newMenu = new Menu();
            $newMenu->name = $faker->words(3, true); // Genera un nome di tre parole
            $newMenu->description = $faker->realText(50);
            $newMenu->category = $faker->randomElement($categories); // Sceglie una categoria casuale
            $newMenu->price = $faker->randomFloat(2, 1, 40); // Prezzo casuale tra 1 e 100 con 2 decimali
            $newMenu->save(); // Salva il nuovo record nel database
        }
    }
}
