<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AC;
use App\Models\User;
use App\Models\ChartAC;
use App\Models\MSession;
use App\Models\TodoModel;
use App\Models\ControlModel;
use App\Models\enerTrackModel;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $bulan = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $tahun = "2022";

        foreach ($bulan as $indeks => $namaBulan) {
            ChartAC::create([
                'tahun' => $tahun,
                'bulan' => $namaBulan,
                'total' => mt_rand(1, 8)
            ]);
        }

        $bulan2 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July'
        ];

        $tahun2 = "2023";

        foreach ($bulan2 as $indeks => $namaBulan2) {
            ChartAC::create([
                'tahun' => $tahun2,
                'bulan' => $namaBulan2,
                'total' => mt_rand(1, 8)
            ]);
        }


        MSession::factory(1)->create();
        AC::factory(250)->create();

        TodoModel::create(['title' => 'Ini adalah contoh todo list!','completed' => 1]);

        ControlModel::create([ 'power' => 0, 'suhu' => 22 ]);

        enerTrackModel::create([ 'suhu' => 22, 'kelembapan' => 65, ]);

        User::create([
            'name' => 'Meong',
            'nik' => "15920011",
            'image' => 'default.png',
            'password' => bcrypt('admin'),
            'status_login' => 'offline',
            'role' => 1,
            'is_active' => 1
        ]);

    }
}
