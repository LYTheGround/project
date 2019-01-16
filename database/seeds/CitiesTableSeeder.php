<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Cities Seeder.
     *
     * @return void
     */
    public function run()
    {
        $cities = ['Agadir', 'Casablanca', 'Rabat'];

        foreach ($cities as $city)

            City::insert(['city' => $city]);

    }
}
