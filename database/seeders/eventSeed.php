<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class eventSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Event::factory()
            ->count(10) // Change the number to the desired amount of events to be seeded
            ->create();
    }
}
