<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aturanData = [
            [
                'disease_id' => '1', // Kode penyakit Influenza Like Common (ILI)
                'symptom_id' => '1', // Kode gejala Batuk
                'weight' => 0.8,
            ],
            [
                'disease_id' => '1',
                'symptom_id' => '2', // Kode gejala Hidung Tersumbat
                'weight' => 0.6,
            ],
            [
                'disease_id' => '1',
                'symptom_id' => '4', // Kode gejala Demam
                'weight' => 0.7,
            ],
            [
                'disease_id' => '2', // Kode penyakit Bronkhitis
                'symptom_id' => '1',
                'weight' => 0.4,
            ],
            [
                'disease_id' => '2',
                'symptom_id' => '3', // Kode gejala Sakit Tenggorokan
                'weight' => 0.7,
            ],
            [
                'disease_id' => '2',
                'symptom_id' => '4',
                'weight' => 0.5,
            ],
            [
                'disease_id' => '3', // Kode penyakit Faringitis
                'symptom_id' => '3',
                'weight' => 0.9,
            ],
            [
                'disease_id' => '3',
                'symptom_id' => '5', // Kode gejala Mual
                'weight' => 0.4,
            ],
            [
                'disease_id' => '3',
                'symptom_id' => '6', // Kode gejala Muntah
                'weight' => 0.6,
            ],
            // Tambahkan aturan lainnya sesuai dengan kombinasi gejala dan penyakit
        ];

        Rule::insert($aturanData);
    }
}
