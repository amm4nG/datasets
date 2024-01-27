<?php

namespace Database\Seeders;

use App\Models\AssociatedTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssociatedTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssociatedTask::create([
            'name_associated_task' => 'Classification'
        ]);
        AssociatedTask::create([
            'name_associated_task' => 'Regression'
        ]);
        AssociatedTask::create([
            'name_associated_task' => 'Clustering'
        ]);
        AssociatedTask::create([
            'name_associated_task' => 'Other'
        ]);
    }
}
