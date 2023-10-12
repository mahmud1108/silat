<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_username' => 'admin',
            'password' => Hash::make('admin'),
            'user_gambar' => $this->faker->word(3),
            'user_no_hp' => $this->faker->numberBetween(),
            'user_email' => $this->faker->email(),
            'user_alamat' => $this->faker->word(),
            'user_nama' => $this->faker->name(),
            'role' => 'admin',
            'user_status' => 'aktif',
        ];
    }
}
