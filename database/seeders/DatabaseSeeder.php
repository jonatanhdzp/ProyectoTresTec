<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Contract;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Client::factory(10)
            ->has(Contract::factory()->count(14)) // cada cliente tendra 3 contratos
            ->create();
    }
}
