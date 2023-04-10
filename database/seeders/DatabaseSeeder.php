<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\CreateProductSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**ADMIN */
        $this->call(CreateAdminUserSeeder::class);

        /**PRODUCTS */
        $this->call(CreateProductSeeder::class);
    }
}
