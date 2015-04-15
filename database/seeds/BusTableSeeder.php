<?php


use Illuminate\Database\Seeder;
use App\TransportStation\Models\Bus;
use App\Station;

class BusTableSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();
        Bus::truncate();

        $arrivalFmt = array('%d min', '%d h');
        $stations = Station::get();

        foreach ($stations as $key => $station)
        {
            for ($i = 1; $i < rand(2, 5); $i++)
            {
                try {
                    Bus::create([
                        'name' => $faker->randomLetter,
                        'station_id' => $station->id,
                        'arrival' => sprintf($arrivalFmt[array_rand($arrivalFmt)], $faker->randomDigit)
                    ]);
                } catch (\Exception $e) {
                    $this->command->info('Seed Error: ' . $e->getMessage());
                }
            }
        }
    }

}