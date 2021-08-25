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
        // PRODUCTS

        $sizeM = new stdClass;
        $sizeM->size = "M";
        $sizeM->quantity = 4;

        $sizeS = new stdClass;
        $sizeS->size = "S";
        $sizeS->quantity = 3;

        $sizeL = new stdClass;
        $sizeL->size = "L";
        $sizeL->quantity = 3;

        $sizeXL = new stdClass;
        $sizeXL->size = "XL";
        $sizeXL->quantity = 3;

        $dataWomen = new stdClass;
        $dataWomen->sizes = [
            $sizeL,
            $sizeM,
            $sizeS,
        ];

        $data = new StdClass();
        $data->sizes = [
            $sizeL,
            $sizeM,
            $sizeXL,
        ];


        $relation = new StdClass();
        $relation->product_id = 2;
        
        $relation2 = new StdClass();
        $relation2->product_id = 5;


        $data->relations = [
            $relation,
            $relation2,
        ];


        DB::table('products')->insert([
            'name' => 'Sudadera Nike',
            'slug' => 'SudaderaNike',
            'description' => 'Sudadera de algodon hecho en India bajo explotación infantil. Producto línea nueva de la colección 24/5.',
            'stock' => 10,
            'price' => 250.00,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Gucci',
            'slug' => 'PantalonGucci',
            'description' => 'Pantalón de piel de cocodrilo, cazado por las manos de Putin. Colección Summer 2021/2022. Diseñado por Martin Pride en colaboración con Louis Viuotton.',
            'stock' => 10,
            'price' => 450.00,
            'sale_price' => 299.99,
            'data' => json_encode($dataWomen),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'Campera abrigada línea Air Jordan en colaboración con Paris Saint-Germain. Indumentaria oficial para los partidos disputador por la UEFA Champions League. ',
            'stock' => 10,
            'price' => 999.99,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Sudadera Puma',
            'slug' => 'SudaderaPuma',
            'description' => 'Campera Puma, importado desde Alemania. Tela suave y abrigada para salir a hacer deporte.',
            'stock' => 10,
            'price' => 480.00,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Remera Gucci',
            'slug' => 'RemeraGucci',
            'description' => 'Remera Gucci colección Summer 2017, en colaboración con Adidas.',
            'stock' => 10,
            'price' => 450.00,
            'data' => json_encode($dataWomen),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera NorthFace',
            'slug' => 'CamperaNorthFace',
            'description' => 'Campera para que puedas subir hasta al monte Everest.',
            'stock' => 10,
            'price' => 799.99,
            'sale_price' => 499.99,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Musculosa Nike',
            'slug' => 'MusculosaNike',
            'description' => 'Musculosa Nike importada de Francia, diseñadada por Louis Vuoton y Givenchy.',
            'stock' => 10,
            'price' => 179.99,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Kappa',
            'slug' => 'PantalonKappa',
            'description' => 'En colaboración con Gucci, llegan estos pantalones pertenecientes a la colección winter 21.',
            'stock' => 10,
            'price' => 420.00,
            'data' => json_encode($dataWomen),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Adidas',
            'slug' => 'CamperaAdidas',
            'description' => 'Campera adidas en colaboracion con Messi.',
            'stock' => 10,
            'price' => 999.99,
            'sale_price' => 599.99,
            'data' => json_encode($data),
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Gorro Gucci',
            'slug' => 'GorroGucci',
            'description' => 'Gorro gucci con toda la onda ansheee.',
            'stock' => 10,
            'price' => 550.00,
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Camisa Burberry',
            'slug' => 'CamisaBurberry',
            'description' => 'Colección winter 2021/22 en colaboración de Ñengo Flow y Myke Towers.',
            'stock' => 10,
            'price' => 1999.99,
            'data' => json_encode($data),
            'is_active' => 1
        ]);
    }
}
