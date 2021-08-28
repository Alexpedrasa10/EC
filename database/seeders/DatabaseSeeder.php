<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Teams::class);
        $this->call(UserAdmin::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PhotoProductsTableSeeder::class);
        $this->call(Properties::class);
        $this->call(PropertiesSystem::class);
        $this->call(ProductPropertiesTableSeeder::class);
    }
}
