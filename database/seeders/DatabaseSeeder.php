<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AC;
use App\Models\User;
use App\Models\ChartAC;
use App\Models\MSession;
use App\Models\TodoModel;
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

        MSession::factory(1)->create();
        // AC::factory(20)->create();
        ChartAC::factory(12)->create();

        TodoModel::create([
            'title' => 'Ini adalah contoh todo list!',
            'completed' => 1
        ]);

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
