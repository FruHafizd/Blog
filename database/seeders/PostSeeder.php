<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, // Ganti dengan ID pengguna yang valid
                'title' => 'Inovasi Terbaru dalam Gadget: 5 Perangkat yang Harus Dimiliki',
                'content' => 'Di era digital ini, gadget semakin canggih dan inovatif. Dari smartphone hingga wearable technology, berikut adalah lima perangkat terbaru yang akan mengubah cara kita berinteraksi dengan teknologi.',
                'slug' => 'inovasi-terbaru-dalam-gadget',
                'published_at' => '2024-09-28 10:00:00',
                'image' => 'images/teknologi-gadget.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Gadget terbaru yang mengubah cara interaksi.',
                'archived' => false,
                'categories_id' => 1
            ],
            [
                'user_id' => 1,
                'title' => '5 Tips Diet Sehat untuk Menjaga Berat Badan Ideal',
                'content' => 'Menjaga berat badan ideal tidak hanya soal mengurangi porsi makan. Berikut adalah lima tips diet sehat yang dapat membantu Anda mencapai tujuan kesehatan Anda.',
                'slug' => 'tips-diet-sehat',
                'published_at' => '2024-09-28 11:00:00',
                'image' => 'images/tips-diet.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Tips diet sehat untuk berat badan ideal.',
                'archived' => false,
                'categories_id' => 2
            ],
            [
                'user_id' => 1,
                'title' => 'Panduan Liburan ke Bali: Tempat Wajib Kunjungi',
                'content' => 'Bali adalah destinasi wisata yang menawarkan keindahan alam dan budaya yang kaya. Berikut adalah panduan lengkap untuk menjelajahi pulau dewata.',
                'slug' => 'panduan-liburan-ke-bali',
                'published_at' => '2024-09-28 12:00:00',
                'image' => 'images/panduan-bali.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Panduan liburan ke Bali.',
                'archived' => false,
                'categories_id' => 3
            ],
            [
                'user_id' => 1,
                'title' => 'Tren Mode Musim Ini: Apa yang Harus Dimiliki',
                'content' => 'Musim ini, tren mode hadir dengan berbagai gaya yang menarik. Simak artikel ini untuk mengetahui apa saja yang harus Anda miliki dalam lemari pakaian Anda.',
                'slug' => 'tren-mode-musim-ini',
                'published_at' => '2024-09-28 13:00:00',
                'image' => 'images/tren-mode.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Tren mode musim ini.',
                'archived' => false,
                'categories_id' => 4
            ],
            [
                'user_id' => 1,
                'title' => 'Tips Investasi untuk Pemula: Mulai dari Mana?',
                'content' => 'Investasi bisa menjadi cara yang baik untuk mengamankan masa depan keuangan Anda. Artikel ini memberikan tips bagi pemula yang ingin memulai investasi.',
                'slug' => 'tips-investasi-untuk-pemula',
                'published_at' => '2024-09-28 14:00:00',
                'image' => 'images/tips-investasi.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Tips investasi untuk pemula.',
                'archived' => false,
                'categories_id' => 5
            ],
            [
                'user_id' => 1,
                'title' => 'Resep Spesial: Pasta Carbonara yang Mudah Dibuat',
                'content' => 'Pasta carbonara adalah hidangan Italia yang lezat dan mudah dibuat. Berikut adalah resep sederhana yang dapat Anda coba di rumah.',
                'slug' => 'resep-pasta-carbonara',
                'published_at' => '2024-09-28 15:00:00',
                'image' => 'images/pasta-carbonara.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Resep pasta carbonara yang mudah.',
                'archived' => false,
                'categories_id' => 6
            ],
            [
                'user_id' => 1,
                'title' => 'Sumber Belajar Online Terbaik untuk Mahasiswa',
                'content' => 'Di era digital, banyak sumber belajar online yang dapat membantu mahasiswa dalam studi mereka. Artikel ini merangkum beberapa platform terbaik.',
                'slug' => 'sumber-belajar-online',
                'published_at' => '2024-09-28 16:00:00',
                'image' => 'images/sumber-belajar.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Sumber belajar online untuk mahasiswa.',
                'archived' => false,
                'categories_id' => 7
            ],
            [
                'user_id' => 1,
                'title' => 'Ulasan Film: Apa yang Menarik dari Film Terbaru',
                'content' => 'Film terbaru ini berhasil menarik perhatian penonton dengan plot yang menegangkan dan akting yang memukau. Simak ulasan lengkapnya di sini.',
                'slug' => 'ulasan-film-terbaru',
                'published_at' => '2024-09-28 17:00:00',
                'image' => 'images/ulasan-film.jpg',
                'view_count' => 0,
                'pin_blog' => false,
                'short_description' => 'Ulasan film terbaru.',
                'archived' => false,
                'categories_id' => 8
            ],
        ];

        foreach ($data as $item) {
            Posts::create($item);
        }
    }
}
