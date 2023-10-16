<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $texts = [
            "Kearifan Lokal: Pendekatan Nusantara menekankan pada pemanfaatan bahan-bahan alami dan teknik tradisional, seperti kayu, bambu, dan anyaman, untuk menciptakan karya arsitektur dan interior yang sesuai dengan lingkungan dan budaya setempat.",
            "Budaya dan Identitas: Pendekatan ini memperhatikan nilai-nilai budaya dan identitas lokal, memastikan bahwa desain mencerminkan warisan budaya dan sejarah masyarakat Nusantara.",
            "Integrasi Seni dan Kerajinan: Seni dan kerajinan tangan tradisional sering diintegrasikan dalam desain, baik sebagai dekorasi atau elemen fungsional dalam arsitektur dan interior.",
            "Detail Ornamen: Ornamen-ornamen tradisional seperti ukiran, mozaik, dan hiasan tangan lainnya sering digunakan dalam desain Nusantara untuk memberikan sentuhan estetika yang khas.",
            "Penggunaan Ruang Terbuka: Desain interior Nusantara cenderung mengedepankan penggunaan ruang terbuka dan tata letak yang mengakomodasi aliran udara dan cahaya alami.",
            "Interaksi Dengan Alam: Desain Nusantara sering memasukkan elemen alam, seperti taman dalam rumah atau kolam renang alami, yang memungkinkan penghuni berinteraksi lebih dekat dengan lingkungan sekitar.",
            "Adaptasi Modern: Meskipun mengandalkan warisan tradisional, pendekatan Nusantara juga bisa menggabungkan elemen-elemen modern untuk menciptakan desain yang harmonis antara masa lalu dan masa kini.",
            "Kehangatan dan Kenyamanan: Sentuhan hangat dan kenyamanan sering menjadi fokus dalam desain Nusantara, menciptakan ruang yang mengundang dan ramah.",
            "Diversitas Regional: Pendekatan Nusantara tidak monolitik, karena setiap wilayah memiliki karakteristik budaya dan lingkungan yang berbeda. Ini menciptakan ruang bagi variasi dalam desain yang mencerminkan keragaman Indonesia.",
            "Keberlanjutan: Desain Nusantara cenderung berfokus pada praktik berkelanjutan, mengintegrasikan elemen-elemen ramah lingkungan seperti penggunaan energi terbarukan dan sistem pencahayaan alami.",
        ];

        $images = [
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628342/ddn/videos/slide-9.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628331/ddn/videos/slide-13.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628320/ddn/videos/slide-15.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628280/ddn/videos/slide-8.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628274/ddn/videos/slide-14.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628255/ddn/videos/slide-10.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628247/ddn/videos/slide-12.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628223/ddn/videos/slide-11.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628206/ddn/videos/slide-7.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628175/ddn/videos/slide-2.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628151/ddn/videos/slide-4.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628146/ddn/videos/slide.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628140/ddn/videos/slide-3.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628130/ddn/videos/slide-6.mp4",
        "https://res.cloudinary.com/djzee3t99/video/upload/v1695628117/ddn/videos/slide-5.mp4",
    ];

        foreach ($texts as $index => $text) {
            Home::create([
                'name' => 'Nusantara',
                'text' => $text,
                'image' => $images[$index % count($images)],
            ]);
        }
    }
}