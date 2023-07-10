<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AC;
use App\Models\Menu;
use App\Models\User;
use App\Models\ChartAC;
use App\Models\Submenu;
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

        TodoModel::create(['title' => 'Ini adalah contoh todo list!', 'completed' => 1]);

        ControlModel::create(['power' => 0, 'suhu' => 22]);

        enerTrackModel::create(['suhu' => 22, 'kelembapan' => 65,]);

        User::create([
            'name' => 'Meong',
            'nik' => "15920011",
            'image' => 'default.png',
            'password' => bcrypt('admin'),
            'status_login' => 'offline',
            'role' => 1,
            'is_active' => 1
        ]);
        User::create([
            'name' => 'Cat',
            'nik' => "15920012",
            'image' => 'default.png',
            'password' => bcrypt('user'),
            'status_login' => 'offline',
            'role' => 0,
            'is_active' => 0
        ]);
        User::create([
            'name' => 'Dog',
            'nik' => "15920013",
            'image' => 'default.png',
            'password' => bcrypt('user'),
            'status_login' => 'offline',
            'role' => 0,
            'is_active' => 0
        ]);

        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'bi bi-house-door-fill',
            'slug' => 'dashboard',
            'data_target' => '#pills-dashboards',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Todo List',
            'icon' => 'bi bi-list-task',
            'slug' => 'todolist',
            'data_target' => '#pills-todolist',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Data Perangkat',
            'icon' => 'bi bi-server',
            'slug' => 'application',
            'data_target' => '#pills-application',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Data Users',
            'icon' => 'bi bi-person-plus-fill',
            'slug' => 'adminMenu',
            'data_target' => '#pills-adminMenu',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Data Charts',
            'icon' => 'bi bi-bar-chart-steps',
            'slug' => 'charts',
            'data_target' => '#pills-charts',
            'status' => true
        ]);
        Menu::create([
            'name' => 'EnerTrack',
            'icon' => 'bi bi-wrench pl-10',
            'slug' => 'enertrack',
            'data_target' => '#pills-enertrack',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Tools',
            'icon' => 'bi bi-tools pl-10',
            'slug' => 'tools',
            'data_target' => '#pills-tools',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Chatbot',
            'icon' => 'bx bxl-android',
            'slug' => 'chatbot',
            'data_target' => '#pills-chatbot',
            'status' => true
        ]);
        Menu::create([
            'name' => 'Settings',
            'icon' => 'bi bi-gear-fill',
            'slug' => 'settings',
            'data_target' => '#pills-settings',
            'status' => true
        ]);


    }
}
