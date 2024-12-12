<?php

namespace Database\Seeders;

use App\Models\Repeat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Repeat::create([
            'name' => 'no repetir',
            'days' => 0
        ]);

        Repeat::create([
            'name' => 'diariamente',
            'days' => 1
        ]);

        Repeat::create([
            'name' => 'semanalmente',
            'days' => 7
        ]);

        Repeat::create([
            'name' => 'mensualmente',
            'days' => 30
        ]);

        Repeat::create([
            'name' => 'anualmente',
            'days' => 365
        ]);
    }
}
