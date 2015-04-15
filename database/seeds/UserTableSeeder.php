<?php


use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();
        User::truncate();

        foreach (range(1, 10) as $index) {
            User::create([
                'email' => $faker->email,
                'password' => Hash::make('1234'),
                'lat' => $faker->latitude,
                'lon' => $faker->longitude
            ]);
        }
    }

}