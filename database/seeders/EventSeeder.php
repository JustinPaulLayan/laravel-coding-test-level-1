<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach( range(1, 20) as $index ){
            Event::create([
                'name' => $faker->name(),
                'startAt' => $faker->dateTime(),
                'endAt' => $faker->dateTime(),
            ]);
        }
    }
}
