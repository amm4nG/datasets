<?php

namespace Database\Seeders;

use App\Models\SubjectArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubjectArea::create([
            'name_subject_area' => 'Biology',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Business',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Climate and Environment',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Computer Science',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Engineering',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Games',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Health and Medicine',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Law',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Physics and Chemistry',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Social Science',
        ]);
        SubjectArea::create([
            'name_subject_area' => 'Other',
        ]);
    }
}
