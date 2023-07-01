<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AC>
 */
class ACFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'label' => $this->faker->randomDigit(),
            'assets' => $this->faker->company(),
            'wing' => $this->faker->sentence(mt_rand(1, 2)),
            'lantai' => mt_rand(1, 3),
            'ruangan' => $this->faker->company(),
            'merk' => $this->faker->company(),
            'type' => $this->faker->sentence(mt_rand(1, 2)),
            'jenis' => $this->faker->sentence(mt_rand(1, 2)),
            'kapasitas' => mt_rand(1, 5),
            'refrigerant' => 'R410',
            'product' => $this->faker->country(),
            'current' => mt_rand(1, 5),
            'voltage' => mt_rand(1, 8),
            'btu' => mt_rand(1, 8),
            'pipa' => "1/4 - 3/8",
            'status' => 'Normal',
            'catatan' => $this->faker->paragraphs(1, true),
            'keterangan' => $this->faker->paragraphs(1, true),
            'tgl_pemasangan' => $this->faker->dateTime(),
            'petugas_pemasangan' => $this->faker->name(),
            'tgl_maintenance' => '1992-08-16 20:00:00',
            'petugas_maint' => 'Rinto',
            'seri_indoor' => mt_rand(1, 5),
            'seri_outdoor' => mt_rand(1, 5)
        ];
    }
}
