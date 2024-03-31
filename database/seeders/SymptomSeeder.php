<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $symptoms = [
            ['name' => 'Demam'],
            ['name' => 'Batuk'],
            ['name' => 'Hidung tersumbat/pilek'],
            ['name' => 'Sakit kepala/pusing'],
            ['name' => 'Sesak nafas/mengi'],
            ['name' => 'Sakit tenggorokan'],
            ['name' => 'Kurang nafsu makan'],
            ['name' => 'Berkurangnya indra pengecap dan bau'],
            ['name' => 'Tulang dan persendian anggota badan sakit'],
            ['name' => 'Bintik merah pada telapak tangan'],
            ['name' => 'Mata berair'],
            ['name' => 'Meriang dan menggigil'],
            ['name' => 'Lesu/lemas'],
            ['name' => 'Nyeri telinga'],
            ['name' => 'Tenggorokan merah dan bengkak'],
            ['name' => 'Suara serak'],
            ['name' => 'Warna merah pada amandel (bengkak)'],
        ];

        Symptom::insert($symptoms);
    }
}
