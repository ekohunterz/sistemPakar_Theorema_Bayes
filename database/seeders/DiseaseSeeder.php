<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            [
                'name' => 'Malaria',
                'description' => 'Malaria is a disease that affects the nervous system. It is caused by the bite of an infected female goat.',
                'image' => null,
                'solution' => 'Get vaccinated.',
            ],
            [
                'name' => 'Diabetes',
                'description' => 'Diabetes is a disease that affects the body\'s ability to make insulin.',
                'image' => null,
                'solution' => 'Get vaccinated.',
            ],
            [
                'name' => 'Hypertension',
                'description' => 'Hypertension is a disease that affects the blood pressure in the body.',
                'image' => null,
                'solution' => 'Get vaccinated.',
            ],
            [
                'name' => 'Covid-19',
                'description' => 'Covid-19 is a disease that affects the respiratory system.',
                'image' => null,
                'solution' => 'Get vaccinated.',
            ]
        ];

        Disease::insert($diseases);
    }
}
