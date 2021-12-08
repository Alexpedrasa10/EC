<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class AddNewOrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::firstOrCreate([
            'category' => "OSTA",
            'code' => "PEND"
        ], [
            'name' => "Pago pendiente"
        ]);
    }
}
