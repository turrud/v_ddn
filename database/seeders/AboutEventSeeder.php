<?php

namespace Database\Seeders;

use App\Models\AboutEvent;
use Illuminate\Database\Seeder;

class AboutEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutEvent::create([
            'name' => 'First Virtual Architecture Exhibitions.',
            'tanggal' => 'Februari 2021',
            'lokasi' => 'Cirebon',
            ]);
        AboutEvent::create([
            'name' => 'First Virtual Batik Exhibitions.',
            'tanggal' => 'Maret 2022',
            'lokasi' => 'Sumedang',
            ]);

        AboutEvent::create([
            'name' => 'Woman Independent days Virtual Exhibitions.',
            'tanggal' => 'Maret 2023',
            'lokasi' => 'Bandung',
        ]);

        AboutEvent::create([
            'name' => 'Seminar Interior in Islam.',
            'tanggal' => 'September 2023',
            'lokasi' => 'Bandung',
        ]);

        AboutEvent::create([
            'name' => '4th Dananjaya Design Exhibitions.',
            'tanggal' => 'Oktober 2023',
            'lokasi' => 'Bandung',
        ]);

        AboutEvent::create([
            'name' => 'Attend 4th Bandung Connecty City.',
            'tanggal' => '2023',
            'lokasi' => 'Bandung',
        ]);

        AboutEvent::create([
            'name' => 'Attend Dekolonialisasi Tinggalan Budaya.',
            'tanggal' => 'September 2023',
            'lokasi' => 'Bandung',
        ]);
        AboutEvent::create([
            'name' => 'Holaqoh Hujroh Online with Ikmas Bandung.',
            'tanggal' => 'September 2023',
            'lokasi' => 'Bandung',
        ]);
    }
}