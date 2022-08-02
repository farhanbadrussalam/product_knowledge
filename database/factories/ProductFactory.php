<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2, 8)),
            'excerpt' => $this->faker->paragraph(),
            'description' => $this->faker->paragraph(mt_rand(2, 5)),
            'harga' => $this->faker->randomNumber(6, true),
            'photo_utama' => '',
            'photo_deskripsi' => '[]',
            'video' => '[]',
            'kategori_id' => random_int(1, 5),
            'user_id' => random_int(1, 5)
        ];
    }
}
