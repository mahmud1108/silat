<?php

namespace Database\Seeders;

use App\Models\Atlet;
use App\Models\Kategori;
use App\Models\KelasUsia;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(2)->create();
        Kategori::factory(2)->create();
        KelasUsia::factory(2)->create();
        Atlet::factory(10)->create();
    }
}
