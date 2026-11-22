<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Content;
use App\Models\Task;
use App\Models\Equipment;     
use App\Models\EquipmentLoan;  
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        User::create([
            'name' => 'Admin Lead',
            'email' => 'admin@tracker.com',
            'password' => $password,
            'role' => 'admin',
        ]);

        $ideKonsep = User::create([
            'name' => 'Andi - Ide Konsep (Kreatif)',
            'email' => 'idekonsep@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $sutradara = User::create([
            'name' => 'Raka - Sutradara (Kreatif)',
            'email' => 'sutradara@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $scriptwriter = User::create([
            'name' => 'Siti - Scriptwriter (Kreatif)',
            'email' => 'scriptwriter@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $medfo = User::create([
            'name' => 'Dina - Medfo (Kreatif)',
            'email' => 'medfo@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $videografer = User::create([
            'name' => 'Budi - Videografer (Produksi)',
            'email' => 'videografer@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $fotografer = User::create([
            'name' => 'Fajar - Fotografer (Produksi)',
            'email' => 'fotografer@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $desainGrafis = User::create([
            'name' => 'Nadia - Desain Grafis (Produksi)',
            'email' => 'desain@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $talent = User::create([
            'name' => 'Reza - Talent (Produksi)',
            'email' => 'talent@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $webMaster = User::create([
            'name' => 'Ilham - Web Master (Produksi)',
            'email' => 'webmaster@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $sponsorship = User::create([
            'name' => 'Kevin - Sponsorship (PR)',
            'email' => 'sponsorship@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $networking = User::create([
            'name' => 'Putri - Networking (PR)',
            'email' => 'networking@tracker.com',
            'password' => $password,
            'role' => 'crew',
        ]);

        $campaign1 = Campaign::create([
            'title' => 'Countdown Event Akhir Tahun',
            'description' => 'Rangkaian konten promosi H-7 sampai hari H acara.',
            'start_date' => now(),
            'end_date' => now()->addDays(14),
            'status' => 'active',
        ]);

        $campaign2 = Campaign::create([
            'title' => 'Publikasi Sponsor & Media Partner',
            'description' => 'Konten kolaborasi dan eksposur brand partner di sosmed serta website.',
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(20),
            'status' => 'active',
        ]);

        $content1 = Content::create([
            'campaign_id' => $campaign1->id,
            'title' => 'Teaser H-7 Event',
            'platform' => 'ig_reels',
            'script_link' => 'https://docs.google.com/document/d/contoh-script-teaser',
            'asset_link' => 'https://drive.google.com/drive/folders/contoh-aset-teaser',
            'status' => 'editing',
            'deadline' => now()->addDays(2),
        ]);

        $content2 = Content::create([
            'campaign_id' => $campaign1->id,
            'title' => 'Aftermovie & Dokumentasi Persiapan',
            'platform' => 'tiktok',
            'status' => 'shooting',
            'deadline' => now()->addDays(4),
        ]);

        $content3 = Content::create([
            'campaign_id' => $campaign2->id,
            'title' => 'Spotlight Sponsor Utama & Banner Web',
            'platform' => 'youtube',
            'status' => 'scripting',
            'deadline' => now()->addDays(6),
        ]);

        // Task untuk Konten 1
        Task::create(['content_id' => $content1->id, 'user_id' => $ideKonsep->id, 'task_name' => 'Brainstorming Konsep & Hook Teaser', 'is_done' => true]);
        Task::create(['content_id' => $content1->id, 'user_id' => $scriptwriter->id, 'task_name' => 'Tulis Script & Dialog VO', 'is_done' => true]);
        Task::create(['content_id' => $content1->id, 'user_id' => $sutradara->id, 'task_name' => 'Directing & Shot List Lapangan', 'is_done' => true]);
        Task::create(['content_id' => $content1->id, 'user_id' => $talent->id, 'task_name' => 'Take Video On-Cam & Voice Over', 'is_done' => true]);
        Task::create(['content_id' => $content1->id, 'user_id' => $videografer->id, 'task_name' => 'Editing Video & Color Grading', 'is_done' => false]);
        Task::create(['content_id' => $content1->id, 'user_id' => $medfo->id, 'task_name' => 'Siapkan Caption, Hashtag & Jadwal Upload', 'is_done' => false]);

        // Task untuk Konten 2
        Task::create(['content_id' => $content2->id, 'user_id' => $fotografer->id, 'task_name' => 'Ambil Foto BTS & Thumbnail', 'is_done' => true]);
        Task::create(['content_id' => $content2->id, 'user_id' => $desainGrafis->id, 'task_name' => 'Desain Cover Reels & Bumper Logo', 'is_done' => false]);

        // Task untuk Konten 3 (PR & Web)
        Task::create(['content_id' => $content3->id, 'user_id' => $sponsorship->id, 'task_name' => 'Kumpulkan Logo HD & Brief dari Sponsor', 'is_done' => true]);
        Task::create(['content_id' => $content3->id, 'user_id' => $networking->id, 'task_name' => 'Koordinasi Cross-Post dengan Media Partner', 'is_done' => false]);
        Task::create(['content_id' => $content3->id, 'user_id' => $webMaster->id, 'task_name' => 'Pasang Banner Sponsor di Landing Page Web', 'is_done' => false]);
   
        // 8. Data Master Alat Produksi
        $cam = Equipment::create(['name' => 'Sony A6400 + Lensa Kit', 'category' => 'kamera', 'stock' => 3]);
        $mic = Equipment::create(['name' => 'DJI Mic 2 Wireless', 'category' => 'audio', 'stock' => 4]);
        $light = Equipment::create(['name' => 'Godox SL60W Lighting', 'category' => 'lighting', 'stock' => 2]);
        $tripod = Equipment::create(['name' => 'Tripod Takara Spirit', 'category' => 'aksesoris', 'stock' => 5]);

        // 9. Data Transaksi Peminjaman Dummy (1 sedang dipinjam, stok Sony jadi berkurang 1 -> sisa 2)
        EquipmentLoan::create([
            'content_id' => $content2->id,
            'user_id' => $videografer->id,
            'equipment_id' => $cam->id,
            'qty' => 1,
            'borrow_date' => now(),
            'status' => 'borrowed',
        ]);
        $cam->decrement('stock', 1);
    }
}