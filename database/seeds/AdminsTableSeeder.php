<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login'     => "admin",
            'email'     => "admin@ly.ly",
            'password'  => bcrypt("066145392mM")
        ])->admin()->create([
            'type' => "A",
            'tel'   => "0657834565",
            'city_id' => 2,
        ]);
    }
}
