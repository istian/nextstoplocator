<?php


use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();
        User::truncate();

        $latLonSets = ['1.288520,103.814188', '1.324672,103.930879', '1.326867,103.949867'];

        foreach (range(1, 10) as $index) {
            list($lat, $lon) = explode(",", $latLonSets[array_rand($latLonSets)]);
            User::create([
                'email' => $faker->email,
                'password' => Hash::make('1234'),
                'name' => $faker->userName,
                'lat' => $lat,
                'lon' => $lon,
                'avatar' => $faker->imageUrl(100, 100, 'people')
            ]);
        }
    }

}