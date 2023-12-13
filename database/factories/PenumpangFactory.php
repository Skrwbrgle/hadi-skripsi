<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenumpangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this . fake()->unique()->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'nama' => $this . fake()->name(),
            'alamat' => $this . fake()->address(),
            'nik' => $this . fake()->nik(),
            'no_telepon' => $this . fake()->phoneNumber(),
        ];
    }
}
