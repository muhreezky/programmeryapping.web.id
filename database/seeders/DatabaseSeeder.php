<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private array $gradients = [
        [35, 111, 42],
        [245, 158, 11],
    ];

    private function makePlaceholderImage(string $text, int $index): string
    {
        [$r, $g, $b] = $this->gradients[$index % count($this->gradients)];

        $width = 1200;
        $height = 630;
        $image = imagecreatetruecolor($width, $height);

        // Simple vertical gradient background
        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $color = imagecolorallocate($image, (int) ($r * (1 - $ratio * 0.4)), (int) ($g * (1 - $ratio * 0.4)), (int) ($b * (1 - $ratio * 0.4)));
            imageline($image, 0, $y, $width, $y, $color);
        }

        $white = imagecolorallocate($image, 255, 255, 255);
        $fontSize = 60;
        $textBox = imagettfbbox($fontSize, 0, $this->fontPath(), $text);
        $textWidth = abs($textBox[2] - $textBox[0]);
        imagettftext($image, $fontSize, 0, (int) (($width - $textWidth) / 2), (int) ($height / 2 + 20), $white, $this->fontPath(), $text);

        $relativePath = 'images/' . \Illuminate\Support\Str::slug($text) . '-' . uniqid() . '.png';
        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($relativePath);
        @mkdir(dirname($fullPath), 0775, true);
        imagepng($image, $fullPath);
        imagedestroy($image);

        return $relativePath;
    }

    private function fontPath(): string
    {
        // Filament ships DejaVu fonts used by its image editor; fall back to system fonts.
        foreach (glob('/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf') ?: glob('/usr/share/fonts/*/**/*.ttf') ?: [] as $font) {
            return $font;
        }

        return __DIR__ . '/../../node_modules/@fontsource/roboto/files/roboto-latin-700-normal.woff';
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Muhammad Rizkiansyah',
            'email' => 'admin@muhrizki.my.id',
            'email_verified_at' => now(),
        ]);

        $this->command?->info('Admin login -> email: admin@muhrizki.my.id / password: password');

        Experience::factory()->create([
            'title' => 'Lead Backend Developer',
            'company' => 'PT Solusi Digital Kreatif',
            'employment_type' => 'Full-time',
            'description' => 'Memimpin tim backend dalam membangun layanan API untuk aplikasi e-commerce dengan ratusan ribu pengguna. Fokus pada arsitektur Laravel, scaling database, dan reliability tagihan payment gateway.',
            'started_at' => now()->subYears(3),
            'is_current' => true,
            'ended_at' => null,
            'sort_order' => 0,
        ]);

        Experience::factory()->create([
            'title' => 'Backend Developer',
            'company' => 'Startup Ceprasindo',
            'employment_type' => 'Full-time',
            'description' => 'Membangun REST API dan modul integrasi pihak ketiga (payment, shipping, notifikasi) untuk platform tiket event menggunakan Laravel dan MySQL.',
            'started_at' => now()->subYears(5)->subDays(100),
            'ended_at' => now()->subYears(3),
            'is_current' => false,
            'sort_order' => 1,
        ]);

        Experience::factory()->create([
            'title' => 'Junior Web Developer',
            'company' => 'CV Web Kreatif Bersama',
            'employment_type' => 'Internship',
            'description' => 'Memulai karier dengan mengembangkan website company profile dan CMS kecil-kecilan. Belajar menulis kode yang rapi dan berguna bagi klien yang tidak terlalu banyak mengerjakan kode sendiri.',
            'started_at' => now()->subYears(6),
            'ended_at' => now()->subYears(5)->subDays(200),
            'is_current' => false,
            'sort_order' => 2,
        ]);

        Education::factory()->create([
            'institution' => 'Universitas Negeri Jakarta',
            'degree' => 'Sarjana Ilmu Komputer (S.Kom.)',
            'field_of_study' => 'Ilmu Komputer',
            'description' => 'Fokus pada pemrograman web dan rekayasa perangkat lunak. Tugas akhir mengusulkan optimasi query database untuk aplikasi berbasis Laravel.',
            'started_at' => now()->subYears(9),
            'ended_at' => now()->subYears(5),
            'is_current' => false,
            'sort_order' => 0,
        ]);

        Education::factory()->create([
            'institution' => 'SMK Negeri 13 Jakarta',
            'degree' => 'Jurusan Rekayasa Perangkat Lunak',
            'field_of_study' => 'Rekayasa Perangkat Lunak',
            'description' => 'Mulai berkenalan dengan dunia web programming, dari HTML, CSS, PHP hingga membangun aplikasi desktop sederhana.',
            'started_at' => now()->subYears(12),
            'ended_at' => now()->subYears(9),
            'is_current' => false,
            'sort_order' => 1,
        ]);

        $projectData = [
            [
                'title' => 'muhrizki.my.id',
                'description' => 'Portofolio pribadi dan blog ini sendiri — dibangun dengan Laravel 12, Filament untuk admin panel, serta Inertia.js + Svelte SSR di sisi frontend. Diharuskan hosting dedicated? Tidak, shared hosting pun sanggup dengan SSR.',
                'url' => 'https://muhrizki.my.id',
                'image' => $this->makePlaceholderImage('muhrizki.my.id', 0),
                'tags' => ['Laravel', 'Filament', 'Svelte', 'Inertia', 'SSR'],
                'featured' => true,
                'sort_order' => 0,
            ],
            [
                'title' => 'Tiket Event Cepras',
                'description' => 'Platform penjualan tiket event online dengan integrasi payment gateway dan QR check-in di gerbang.',
                'url' => 'https://example.com',
                'image' => $this->makePlaceholderImage('Tiket Event Cepras', 1),
                'tags' => ['Laravel', 'MySQL', 'Redis', 'QR Code'],
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'API Katalog Buku',
                'description' => 'REST API katalog perpustakaan dengan dokumentasi OpenAPI, rate-limiting, dan cache per-request yang ringan.',
                'url' => 'https://github.com/rizki/katalog-buku',
                'image' => $this->makePlaceholderImage('API Katalog Buku', 0),
                'tags' => ['Laravel', 'PostgreSQL', 'OpenAPI'],
                'featured' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Dashboard Monitoring IoT',
                'description' => 'Dashboard realtime untuk memantau sensor suhu dan kelembaban gudang menggunakan WebSocket.',
                'url' => 'https://example.org',
                'image' => $this->makePlaceholderImage('Dashboard Monitoring IoT', 1),
                'tags' => ['Node.js', 'Socket.IO', 'Vue'],
                'featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($projectData as $project) {
            Project::factory()->create($project);
        }

        $postData = [
            [
                'title' => 'Membangun Blog dengan Laravel dan Filament',
                'content' => '<p>Blog ini ternyata nggak pakai CMS berat, cukup <strong>Laravel</strong> plus <strong>Filament</strong> untuk panel administrasinya. Rasanya seperti bikin kopi racikan sendiri: tahu betul setiap bahan yang masuk.</p><p>Filament mempermudah saya membuat CRUD artikel tanpa perlu menimbun widget JS. Cukup resource, form, dan tabel — jadi deh admin yang rapi.</p><p>Pelajaran paling berkesan: jangan menimbun kode. Tulis seperlunya, uji, lalu tinggal minum kopi sambil melihat situs berkembang.</p>',
            ],
            [
                'title' => 'SSR Aplikasi Inertia di Shared Hosting',
                'content' => '<p>Banyak yang bilang SSR itu mustahil di shared hosting. Ternyata tidak — asalkan hosting-nya menyediakan Node.js, kita bisa menjalankan server SSR dari <code>bootstrap/ssr</code>.</p><p>Caranya: build aset dengan <code>npm run build</code>, jalankan <code>node bootstrap/ssr/ssr.mjs</code>, lalu set <code>inertia.ssr.enabled</code>. Jika server Node tidak sehat, Laravel otomatis melakukan fallback ke rendering client-side.</p><p>Tips: selalu pastikan host memberi akses port internal, dan monitor penggunaan memori — Node SSR ini cukup rakus kalau trafik tinggi.</p>',
            ],
            [
                'title' => 'Cerita Di Balik Portofolio Pribadi',
                'content' => '<p>Membuat portofolio itu seni menampilkan diri tanpa berlebihan. Kumpulan pekerjaan, pengalaman, dan tulisan dipilih yang memang berguna bagi calon kerja sama.</p><p>Semua konten di halaman depan (pengalaman, pendidikan, proyek) diambil langsung dari database, bisa diperbarui kapan saja lewat admin panel tanpa menyentuh kode.</p><p>Selamat mampir, dan jangan ragu menghubungi lewat form kontak di bawah halaman utama!</p>',
            ],
        ];

        foreach ($postData as $index => $post) {
            Post::factory()->create([
                ...$post,
                'headline_image' => $this->makePlaceholderImage(\Illuminate\Support\Str::limit($post['title'], 30), $index),
                'author_id' => $admin->id,
            ]);
        }
    }
}
