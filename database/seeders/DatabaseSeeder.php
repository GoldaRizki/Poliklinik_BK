<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Database\Seeders\TestRelasi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([TestRelasi::class]);
    }
}
