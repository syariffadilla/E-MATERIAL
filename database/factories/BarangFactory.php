<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    protected $model = Barang::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->sentence,
            'kategori_barang_id' => $this->faker->numberBetween(1, 4),
            'stok' => $this->faker->numberBetween(0, 100),
            'harga_barang' => $this->faker->numberBetween(25000, 1000000),
            'pcs' => $this->faker->numberBetween(0, 100),
            'kategori_satuan_id' => $this->faker->numberBetween(1, 4),
            'is_active' => $this->faker->numberBetween(1, 1),
        ];
    }
}
