<?php

namespace Database\Seeders;

use App\Models\AboutClient;
use Illuminate\Database\Seeder;

class AboutClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "Atmosphere Vintage cafe Tulungagung",
            "Ayam Bros Pekalongan",
            "Bandung ArtMonth",
            "Beranda Group Bandung",
            "Cafe Cinta Sumedang",
            "Cilensi Sumedang",
            "Dapur Ibu Jakarta",
            "Desa Pemerintahan Curug Pandeglang",
            "Desa Pemerintahan Curug Pandeglang",
            "Mr. Agus Jakarta Pusat",
            "Mr. Bayu (prg Cimahi)",
            "Mr. Budianto Banyuwani",
            "Mr. Fajar (prg) Garut",
            "Mr. Josh Cirebon",
            "Mr. Mang Kijen Solo",
            "Mr. Ramadhani (prg) Joja",
            "Mr. Santiago Equador",
            "Mr. Surya Kencara (prg) Garut",
            "Mr. Thoriq Junduallah UAE",
            "Mr. Toyo (prg) Tulungagung",
            "Nafira Batik Sumedang",
            "NS. id Surakarta",
            "Ny. Bambandhea (prg) Sidoarjo",
            "Ny. Fahtin (prg) Bandung",
            "Ny. Frahi.me (prg) Madiun",
            "Ny. Kania.A (prg) Bandung",
            "Ny. Lina (prg) Cirebon",
            "Ny. Lina (prg) Cimahi",
            "Ny. Salsali (prg) Cirebon",
            "Ny. Via (prg) Sumedang",
            "Omahin Bandung",
            "Perusahaan Abaya Amiati Sumedang",
            "Perusahaan Asta Dev Bandung",
            "Perusahaan Bio Farma Bandung",
            "Perusahaan Cafe Cinta Sumedang",
            "Perusahaan Cilensi Sumedang",
            "Perusahaan GWO Sumedang",
            "Perusahaan Gladir Glasses Semedang",
            "Perusahaan Glow Beauty Sumedang",
            "Perusahaan Hauza.id Sumedang",
            "Perusahaan Ibana Cirebon",
            "Perusahaan Industri Telekomunikasi Indonesia Bandung",
            "Perusahaan Jaba HD Sumedang",
            "Perusahaan JOJO Cafe Bandung Barat",
            "Perusahaan Kedai Tjikopi Bandung",
            "Perusahaan Ketrak Ketrok Sumedang",
            "Perusahaan Nafira Batik Sumedang",
            "Perusahaan NS. id Surakarta",
            "Perusahaan Omahin Bandung",
            "Perusahaan Rasa Boga Sumedang",
            "Perusahaan Sawung Cibimbing Sumedang",
            "Perusahaan Sejarah Studio",
            "Perusahaan Suri Tani Pemuka Cirebon",
            "Perusahaan Tewuh Sumedang",
            "Perusahaan Wisma Permata 1 Bandung",
            "Perusahaan Wening Sumedang",
            "PPMI Assalaam Sukoharjo",
            "Purple Eca Bandung",
            "SMA Islam Al-Azhar Cirebon",
            "Sri Lestari Flower",
            "Sumowo Soter Sumowono, Semarang, Sarangan",
            "TK Desa Curug Pandeglang",
            "Yayasan Putra Bangsa Cirebon",
            "Yummy Kost Cirebon",
        ];

        foreach ($names as $name) {
            AboutClient::create([
               'name' => $name,
            ]);
        }
    }
}