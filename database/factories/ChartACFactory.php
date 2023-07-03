<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChartAC>
 */
class ChartACFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // $bulan = [
        //     'January',
        //     'February',
        //     'March',
        //     'April',
        //     'May',
        //     'June',
        //     'July',
        //     'August',
        //     'September',
        //     'October',
        //     'November',
        //     'December'
        // ];

        // $faker = \Faker\Factory::create();
        // $faker->unique(true);

        // $dataChart = [];

        // for ($i = 0; $i < 12; $i++) {
        //     $index = $i % 12; // Menggunakan modulo untuk memastikan indeks tetap berada dalam rentang 0-11
        //     $dataChart[] = [
        //         'tahun' => '2022',
        //         'bulan' => $bulan[$index],
        //         'total' => $faker->numberBetween(1, 8)
        //     ];
        // }

        // return $dataChart;

        return [];
    }
}
