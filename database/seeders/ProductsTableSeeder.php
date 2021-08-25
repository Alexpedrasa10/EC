<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sudadera Nike',
                'slug' => 'SudaderaNike',
                'description' => 'Sudadera de algodon hecho en India bajo explotación infantil. Producto línea nueva de la colección 24/5.',
                'stock' => '10.00',
                'price' => 250.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pantalón Gucci',
                'slug' => 'PantalonGucci',
                'description' => 'Pantalón de piel de cocodrilo, cazado por las manos de Putin. Colección Summer 2021/2022. Diseñado por Martin Pride en colaboración con Louis Viuotton.',
                'stock' => '10.00',
                'price' => 450.0,
                'sale_price' => 299.99,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "S", "quantity": 3}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Campera Air Jordan',
                'slug' => 'CamperaAirJordan',
                'description' => 'Campera abrigada línea Air Jordan en colaboración con Paris Saint-Germain. Indumentaria oficial para los partidos disputador por la UEFA Champions League. ',
                'stock' => '10.00',
                'price' => 999.99,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Sudadera Puma',
                'slug' => 'SudaderaPuma',
                'description' => 'Campera Puma, importado desde Alemania. Tela suave y abrigada para salir a hacer deporte.',
                'stock' => '10.00',
                'price' => 480.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Remera Gucci',
                'slug' => 'RemeraGucci',
                'description' => 'Remera Gucci colección Summer 2017, en colaboración con Adidas.',
                'stock' => '10.00',
                'price' => 450.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "S", "quantity": 3}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Campera NorthFace',
                'slug' => 'CamperaNorthFace',
                'description' => 'Campera para que puedas subir hasta al monte Everest.',
                'stock' => '10.00',
                'price' => 799.99,
                'sale_price' => 499.99,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Musculosa Nike',
                'slug' => 'MusculosaNike',
                'description' => 'Musculosa Nike importada de Francia, diseñadada por Louis Vuoton y Givenchy.',
                'stock' => '10.00',
                'price' => 179.99,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Pantalón Kappa',
                'slug' => 'PantalonKappa',
                'description' => 'En colaboración con Gucci, llegan estos pantalones pertenecientes a la colección winter 21.',
                'stock' => '10.00',
                'price' => 420.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "S", "quantity": 3}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Campera Adidas',
                'slug' => 'CamperaAdidas',
                'description' => 'Campera adidas en colaboracion con Messi.',
                'stock' => '10.00',
                'price' => 999.99,
                'sale_price' => 599.99,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Gorro Gucci',
                'slug' => 'GorroGucci',
                'description' => 'Gorro gucci con toda la onda ansheee.',
                'stock' => '10.00',
                'price' => 550.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => NULL,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Camisa Burberry',
                'slug' => 'CamisaBurberry',
                'description' => 'Colección winter 2021/22 en colaboración de Ñengo Flow y Myke Towers.',
                'stock' => '10.00',
                'price' => 1999.99,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}