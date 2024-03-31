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
                'name' => 'Influenza Like Common (ILI)',
                'description' => 'Influenza Like Common (ILI) adalah penyakit pernapasan yang umum disebabkan oleh virus. Gejalanya termasuk demam, pilek, batuk, sakit tenggorokan, dan nyeri otot.',
                'solution' => 'Istirahat yang cukup, minum air putih, konsumsi obat flu sesuai anjuran dokter.',
            ],
            [
                'name' => 'Bronkhitis',
                'description' => 'Bronkhitis adalah peradangan saluran bronkial yang menyebabkan batuk persisten dengan lendir. Gejala lainnya termasuk sesak napas dan nyeri dada.',
                'solution' => 'Istirahat, minum banyak air, obat batuk dan pereda nyeri jika diperlukan.',
            ],
            [
                'name' => 'Faringitis',
                'description' => 'Faringitis adalah peradangan pada tenggorokan yang dapat menyebabkan sakit tenggorokan, kemerahan, dan sulit menelan. Biasanya disebabkan oleh infeksi virus atau bakteri.',
                'solution' => 'Minum air hangat, garam air garam, istirahat yang cukup, konsumsi obat pereda nyeri tenggorokan.',
            ],
            [
                'name' => 'Tonsilitis',
                'description' => 'Tonsilitis adalah peradangan amandel, organ kecil di belakang tenggorokan. Gejala umum termasuk sakit tenggorokan, kesulitan menelan, dan mungkin demam.',
                'solution' => 'Minum air hangat, garam air garam, istirahat yang cukup, konsumsi obat pereda nyeri tenggorokan.',
            ],
        ];

        Disease::insert($diseases);
    }
}
