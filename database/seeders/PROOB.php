<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use stdClass;

class PROOB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'category' => 'GENDER',
            'code' => 'M',
            'name' => 'Hombre'
        ]);

        DB::table('properties')->insert([
            'category' => 'GENDER',
            'code' => 'W',
            'name' => 'Mujer'
        ]);

        DB::table('properties')->insert([
            'category' => 'CAT',
            'code' => 'SPORT',
            'name' => 'Ropa deportiva',
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => 'PANT',
            'name' => 'Pantalón'
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => 'TSHIRT',
            'name' => 'Remera'
        ]);

        // PRODUCTS

        $categories = new stdClass;
        $categories->categories = 1;

        $sizeM = new stdClass;
        $sizeM->size = "M";
        $sizeM->quantity = 4;

        $sizeS = new stdClass;
        $sizeS->size = "S";
        $sizeS->quantity = 3;

        $sizeL = new stdClass;
        $sizeL->size = "L";
        $sizeL->quantity = 3;

        $allSizes = new stdClass;
        $allSizes->sizes = [
            $sizeL,
            $sizeM,
            $sizeS,
        ];



        DB::table('products')->insert([
            'name' => 'Sudadera Nike',
            'slug' => 'SudaderaNike',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 250.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Gucci',
            'slug' => 'PantalonGucci',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 450.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 999.99,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Sudadera Puma',
            'slug' => 'SudaderaPuma',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 480.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Remera Gucci',
            'slug' => 'RemeraGucci',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 450.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera NorthFace',
            'slug' => 'CamperaNorthFace',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 799.99,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Musculosa Nike',
            'slug' => 'MusculosaNike',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 179.99,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Kappa',
            'slug' => 'PantalonKappa',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 420.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 999.99,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Campera Adidas',
            'slug' => 'CamperaAdidas',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 300.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Medias Gucci',
            'slug' => 'CamperaAdidas',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 150.00,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Burberry',
            'slug' => 'CamperaAdidas',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 1999.99,
            'category' => json_encode($categories),
            'data' => json_encode($allSizes),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);
    }
}
