<?php

namespace Database\Factories;

use App\Models\Atlet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**=>
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atlet>
 */
class AtletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'atlet_nama_lengkap' => $this->faker->name(),
            'atlet_tempat_lahir' => $this->faker->word(),
            'atlet_tanggal_lahir' => $this->faker->date('Y-m-d'),
            'atlet_jenis_kelamin' => 'L',
            'atlet_alamat' => $this->faker->word(),
            'no_hp' => $this->faker->randomNumber(),
            'atlet_foto' => $this->faker->word(3),
            'atlet_email' => $this->faker->email(),
            'password' => Hash::make('atlet'),
            'atlet_status' => 'Aktif',
            'atlet_keterangan' => $this->faker->word(),
            'kategori_id' => 1,
            'kelas_usia_id' => 1
        ];
    }
}
