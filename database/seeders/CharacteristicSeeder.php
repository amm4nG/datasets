<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Characteristic::create([
            'name_characteristic' => 'Tabular',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Sequential',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Multivariate',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Time-Series',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Text',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Image',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Spatiotemporal',
        ]);
        Characteristic::create([
            'name_characteristic' => 'Other',
        ]);
    }
}
