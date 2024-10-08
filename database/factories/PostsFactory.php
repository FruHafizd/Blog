<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    protected $model = Posts::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'title' => $this->faker->unique()->sentence(10),
            'content' => $this->faker->paragraph(5),
            'short_description' => $this->faker->paragraph(1000),
            'slug' => $this->faker->unique()->slug,
            'published_at' => now(),
            'image' => 'images/hbp1hiWoyWeHs2Lqn1HcMHKEubhJD8mFiCyXRZA4.png', // Sesuaikan dengan path gambar yang ada
            'view_count' => 0,
            'pin_blog' => $this->faker->boolean,
            'categories_id' => 5, // Menggunakan factory untuk kategori
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // public function configure()
    // {
    //     // return $this->afterCreating(function (Posts $post) {
    //     //     // Mengisi konten dan slug sesuai data dummy yang Anda sediakan
    //     //     $data = [
    //     //         [
    //     //             'title' => 'Inovasi Terbaru dalam Gadget: 5 Perangkat yang Harus Dimiliki',
    //     //             'content' => 'Di era digital ini, gadget semakin canggih dan inovatif. Dari smartphone hingga wearable technology, berikut adalah lima perangkat terbaru yang akan mengubah cara kita berinteraksi dengan teknologi.',
    //     //             'slug' => 'inovasi-terbaru-dalam-gadget',
    //     //             'published_at' => '2024-09-28 10:00:00',
    //     //             'image' => 'images/teknologi-gadget.jpg',
    //     //             'categories_id' => 1
    //     //         ],
    //     //         [
    //     //             'title' => '5 Tips Diet Sehat untuk Menjaga Berat Badan Ideal',
    //     //             'content' => 'Menjaga berat badan ideal tidak hanya soal mengurangi porsi makan. Berikut adalah lima tips diet sehat yang dapat membantu Anda mencapai tujuan kesehatan Anda.',
    //     //             'slug' => 'tips-diet-sehat',
    //     //             'published_at' => '2024-09-28 11:00:00',
    //     //             'image' => 'images/tips-diet.jpg',
    //     //             'categories_id' => 2
    //     //         ],
    //     //         [
    //     //             'title' => 'Panduan Liburan ke Bali: Tempat Wajib Kunjungi',
    //     //             'content' => 'Bali adalah destinasi wisata yang menawarkan keindahan alam dan budaya yang kaya. Berikut adalah panduan lengkap untuk menjelajahi pulau dewata.',
    //     //             'slug' => 'panduan-liburan-ke-bali',
    //     //             'published_at' => '2024-09-28 12:00:00',
    //     //             'image' => 'images/panduan-bali.jpg',
    //     //             'categories_id' => 3
    //     //         ],
    //     //         [
    //     //             'title' => 'Tren Mode Musim Ini: Apa yang Harus Dimiliki',
    //     //             'content' => 'Musim ini, tren mode hadir dengan berbagai gaya yang menarik. Simak artikel ini untuk mengetahui apa saja yang harus Anda miliki dalam lemari pakaian Anda.',
    //     //             'slug' => 'tren-mode-musim-ini',
    //     //             'published_at' => '2024-09-28 13:00:00',
    //     //             'image' => 'images/tren-mode.jpg',
    //     //             'categories_id' => 4
    //     //         ],
    //     //         [
    //     //             'title' => 'Tips Investasi untuk Pemula: Mulai dari Mana?',
    //     //             'content' => 'Investasi bisa menjadi cara yang baik untuk mengamankan masa depan keuangan Anda. Artikel ini memberikan tips bagi pemula yang ingin memulai investasi.',
    //     //             'slug' => 'tips-investasi-untuk-pemula',
    //     //             'published_at' => '2024-09-28 14:00:00',
    //     //             'image' => 'images/tips-investasi.jpg',
    //     //             'categories_id' => 5
    //     //         ],
    //     //         [
    //     //             'title' => 'Resep Spesial: Pasta Carbonara yang Mudah Dibuat',
    //     //             'content' => 'Pasta carbonara adalah hidangan Italia yang lezat dan mudah dibuat. Berikut adalah resep sederhana yang dapat Anda coba di rumah.',
    //     //             'slug' => 'resep-pasta-carbonara',
    //     //             'published_at' => '2024-09-28 15:00:00',
    //     //             'image' => 'images/pasta-carbonara.jpg',
    //     //             'categories_id' => 6
    //     //         ],
    //     //         [
    //     //             'title' => 'Sumber Belajar Online Terbaik untuk Mahasiswa',
    //     //             'content' => 'Di era digital, banyak sumber belajar online yang dapat membantu mahasiswa dalam studi mereka. Artikel ini merangkum beberapa platform terbaik.',
    //     //             'slug' => 'sumber-belajar-online',
    //     //             'published_at' => '2024-09-28 16:00:00',
    //     //             'image' => 'images/sumber-belajar.jpg',
    //     //             'categories_id' => 7
    //     //         ],
    //     //         [
    //     //             'title' => 'Ulasan Film: Apa yang Menarik dari Film Terbaru',
    //     //             'content' => 'Film terbaru ini berhasil menarik perhatian penonton dengan plot yang menegangkan dan akting yang memukau. Simak ulasan lengkapnya di sini.',
    //     //             'slug' => 'ulasan-film-terbaru',
    //     //             'published_at' => '2024-09-28 17:00:00',
    //     //             'image' => 'images/ulasan-film.jpg',
    //     //             'categories_id' => 8
    //     //         ]
    //     //     ];

    //     //     foreach ($data as $item) {
    //     //         $post->create($item);
    //     //     }
    //     // });
    // }
}
