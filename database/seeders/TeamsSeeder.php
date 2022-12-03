<?php

namespace Database\Seeders;

use App\Models\Teams;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teams::factory()
        ->times(3)
        ->hasPlayers(4)
        ->create();
    }
}
