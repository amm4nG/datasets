<?php

namespace Database\Seeders;

use App\Models\FeatureType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeatureType::create([
            'name_feature_type' => 'Real',
        ]);
        FeatureType::create([
            'name_feature_type' => 'Categorial',
        ]);
        FeatureType::create([
            'name_feature_type' => 'Integer',
        ]);
    }
}
