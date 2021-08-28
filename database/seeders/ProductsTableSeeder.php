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
                'stock' => '21.00',
                'price' => 250.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 2}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 5}, {"size": "XS", "quantity": "10"}], "relations": [{"product_id": 5}, {"product_id": 4}, {"product_id": 3}, {"product_id": 1}]}',
                'photo_id' => 1,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 19:39:55',
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
                'photo_id' => 2,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:03:32',
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
                'photo_id' => 3,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:03:32',
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
                'photo_id' => 4,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:03:32',
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
                'photo_id' => 5,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:03:32',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Campera NorthFace',
                'slug' => 'CamperaNorthFace',
                'description' => 'Campera para que puedas subir hasta al monte Everest.',
                'stock' => '27.00',
                'price' => 799.99,
                'sale_price' => 499.99,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 5}, {"size": "M", "quantity": 9}, {"size": "XL", "quantity": 13}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'photo_id' => 6,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:26:54',
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
                'photo_id' => 7,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:03:32',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Pantalón Kappa',
                'slug' => 'PantalonKappa',
                'description' => 'En colaboración con Gucci, llegan estos pantalones pertenecientes a la colección winter 21.',
                'stock' => '22.00',
                'price' => 420.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 11}, {"size": "M", "quantity": 6}, {"size": "S", "quantity": 5}], "relations": [{"product_id": 1}, {"product_id": 3}, {"product_id": 2}]}',
                'photo_id' => 8,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:30:30',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Campera Adidas',
                'slug' => 'CamperaAdidas',
                'description' => 'Campera adidas en colaboracion con Messi.',
                'stock' => '32.00',
                'price' => 999.99,
                'sale_price' => 599.99,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 7}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 8}, {"size": "XXL", "quantity": "6"}, {"size": "S", "quantity": 7}], "relations": [{"product_id": 2}, {"product_id": 5}, {"product_id": 4}, {"product_id": 3}]}',
                'photo_id' => 9,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:24:18',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Gorro Gucci',
                'slug' => 'GorroGucci',
                'description' => 'Gorro gucci con toda la onda ansheee.',
                'stock' => '10.00',
                'price' => 4500.0,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"relations": [{"product_id": 5}, {"product_id": 2}, {"product_id": 6}, {"product_id": 12}]}',
                'photo_id' => 10,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:28:06',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Camisa Burberry',
                'slug' => 'CamisaBurberry',
                'description' => 'Colección winter 2021/22 en colaboración de Ñengo Flow y Myke Towers.',
                'stock' => '27.00',
                'price' => 1999.99,
                'sale_price' => NULL,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 6}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}, {"size": "XS", "quantity": "14"}], "relations": [{"product_id": 2}, {"product_id": 5}, {"product_id": 6}, {"product_id": 9}]}',
                'photo_id' => 11,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-08-28 00:29:22',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Camiseta PSG Visitante 21/22',
                'slug' => 'CamisetaPSGVisitante2122',
                'description' => 'Camiseta suplente del Paris Saint-Germain para la temporada 2021/22.',
                'stock' => '10.00',
                'price' => 12000.0,
                'sale_price' => 9999.0,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": 3}, {"size": "M", "quantity": 4}, {"size": "XL", "quantity": 3}], "relations": [{"product_id": 2}, {"product_id": 5}]}',
                'photo_id' => 12,
                'is_active' => 1,
                'created_at' => '2021-08-28 00:18:33',
                'updated_at' => '2021-08-28 00:24:18',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Pantalon PSG Temporada 22-23',
                'slug' => 'PantalonPSGTemporada22-23',
            'description' => 'Pantalon de fútbol del club parisino confeccionado por Nike (FR) para toda la temporada 2022/23. En colaboración con Jordan.',
                'stock' => '9.00',
                'price' => 10000.0,
                'sale_price' => 8500.0,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "XL", "quantity": "4"}, {"size": "XS", "quantity": "5"}], "relations": [{"product_id": 1}, {"product_id": 3}, {"product_id": 12}, {"product_id": 9}]}',
                'photo_id' => 13,
                'is_active' => 1,
                'created_at' => '2021-08-28 19:48:33',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Camiseta PSG Jordan - Champions 2020',
                'slug' => 'CamisetaPSGJordan-Champions2020',
                'description' => 'Camiseta PSG en colaboración con Jordan utilizada en todos los partidos de UEFA Champions League de la temporada 2020 en la que el equipo parisino llegó a la final.',
                'stock' => '24.00',
                'price' => 8500.0,
                'sale_price' => 7500.0,
                'code' => NULL,
                'data' => '{"sizes": [{"size": "L", "quantity": "14"}, {"size": "S", "quantity": "6"}, {"size": "M", "quantity": "4"}], "relations": [{"product_id": 1}, {"product_id": 13}, {"product_id": 12}, {"product_id": 3}]}',
                'photo_id' => 14,
                'is_active' => 1,
                'created_at' => '2021-08-28 20:02:31',
                'updated_at' => '2021-08-28 20:02:34',
            ),
        ));
        
        
    }
}