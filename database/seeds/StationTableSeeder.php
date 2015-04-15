<?php


use Illuminate\Database\Seeder;
use App\TransportStation\Models\Station;

class StationTableSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();
        Station::truncate();

        foreach (range(1, 10) as $index) {
            Station::create([
                'name' => $faker->streetName . ', ' . $faker->streetSuffix,
                'description' => $faker->sentence(1),
                'address' => $faker->address,
                'type' => 'Bus',
                'lat' => $faker->latitude,
                'lon' => $faker->longitude
            ]);
        }
    }

}