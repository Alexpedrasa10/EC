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
        $this->call(PROOB::class);
    }
}
