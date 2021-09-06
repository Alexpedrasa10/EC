<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductPropertiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_categories')->delete();
        
        \DB::table('product_categories')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'category_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'product_id' => 1,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'product_id' => 2,
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'product_id' => 2,
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'product_id' => 2,
                'category_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'product_id' => 2,
                'category_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'product_id' => 3,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'product_id' => 3,
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'product_id' => 4,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'product_id' => 4,
                'category_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'product_id' => 5,
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'product_id' => 5,
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'product_id' => 5,
                'category_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'product_id' => 6,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'product_id' => 6,
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'product_id' => 7,
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'product_id' => 7,
                'category_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'product_id' => 1,
                'category_id' => 2,
                'created_at' => '2021-08-28 00:06:52',
                'updated_at' => '2021-08-28 00:06:52',
            ),
            18 => 
            array (
                'product_id' => 1,
                'category_id' => 4,
                'created_at' => '2021-08-28 00:06:52',
                'updated_at' => '2021-08-28 00:06:52',
            ),
            19 => 
            array (
                'product_id' => 1,
                'category_id' => 8,
                'created_at' => '2021-08-28 00:06:52',
                'updated_at' => '2021-08-28 00:06:52',
            ),
            20 => 
            array (
                'product_id' => 1,
                'category_id' => 10,
                'created_at' => '2021-08-28 00:06:52',
                'updated_at' => '2021-08-28 00:06:52',
            ),
            21 => 
            array (
                'product_id' => 9,
                'category_id' => 1,
                'created_at' => '2021-08-28 00:13:06',
                'updated_at' => '2021-08-28 00:13:06',
            ),
            22 => 
            array (
                'product_id' => 9,
                'category_id' => 3,
                'created_at' => '2021-08-28 00:13:06',
                'updated_at' => '2021-08-28 00:13:06',
            ),
            23 => 
            array (
                'product_id' => 9,
                'category_id' => 4,
                'created_at' => '2021-08-28 00:13:06',
                'updated_at' => '2021-08-28 00:13:06',
            ),
            24 => 
            array (
                'product_id' => 9,
                'category_id' => 11,
                'created_at' => '2021-08-28 00:13:06',
                'updated_at' => '2021-08-28 00:13:06',
            ),
            25 => 
            array (
                'product_id' => 9,
                'category_id' => 8,
                'created_at' => '2021-08-28 00:13:06',
                'updated_at' => '2021-08-28 00:13:06',
            ),
            26 => 
            array (
                'product_id' => 12,
                'category_id' => 1,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            27 => 
            array (
                'product_id' => 12,
                'category_id' => 2,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            28 => 
            array (
                'product_id' => 12,
                'category_id' => 3,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            29 => 
            array (
                'product_id' => 12,
                'category_id' => 10,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            30 => 
            array (
                'product_id' => 12,
                'category_id' => 9,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            31 => 
            array (
                'product_id' => 6,
                'category_id' => 14,
                'created_at' => '2021-08-28 00:26:54',
                'updated_at' => '2021-08-28 00:26:54',
            ),
            32 => 
            array (
                'product_id' => 10,
                'category_id' => 2,
                'created_at' => '2021-08-28 00:27:16',
                'updated_at' => '2021-08-28 00:27:16',
            ),
            33 => 
            array (
                'product_id' => 10,
                'category_id' => 1,
                'created_at' => '2021-08-28 00:27:16',
                'updated_at' => '2021-08-28 00:27:16',
            ),
            34 => 
            array (
                'product_id' => 10,
                'category_id' => 4,
                'created_at' => '2021-08-28 00:27:16',
                'updated_at' => '2021-08-28 00:27:16',
            ),
            35 => 
            array (
                'product_id' => 10,
                'category_id' => 5,
                'created_at' => '2021-08-28 00:27:16',
                'updated_at' => '2021-08-28 00:27:16',
            ),
            36 => 
            array (
                'product_id' => 10,
                'category_id' => 13,
                'created_at' => '2021-08-28 00:27:16',
                'updated_at' => '2021-08-28 00:27:16',
            ),
            37 => 
            array (
                'product_id' => 11,
                'category_id' => 15,
                'created_at' => '2021-08-28 00:29:22',
                'updated_at' => '2021-08-28 00:29:22',
            ),
            38 => 
            array (
                'product_id' => 11,
                'category_id' => 8,
                'created_at' => '2021-08-28 00:29:22',
                'updated_at' => '2021-08-28 00:29:22',
            ),
            39 => 
            array (
                'product_id' => 11,
                'category_id' => 4,
                'created_at' => '2021-08-28 00:29:22',
                'updated_at' => '2021-08-28 00:29:22',
            ),
            40 => 
            array (
                'product_id' => 11,
                'category_id' => 1,
                'created_at' => '2021-08-28 00:29:22',
                'updated_at' => '2021-08-28 00:29:22',
            ),
            41 => 
            array (
                'product_id' => 8,
                'category_id' => 1,
                'created_at' => '2021-08-28 00:30:30',
                'updated_at' => '2021-08-28 00:30:30',
            ),
            42 => 
            array (
                'product_id' => 8,
                'category_id' => 3,
                'created_at' => '2021-08-28 00:30:30',
                'updated_at' => '2021-08-28 00:30:30',
            ),
            43 => 
            array (
                'product_id' => 8,
                'category_id' => 12,
                'created_at' => '2021-08-28 00:30:30',
                'updated_at' => '2021-08-28 00:30:30',
            ),
            44 => 
            array (
                'product_id' => 13,
                'category_id' => 1,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            45 => 
            array (
                'product_id' => 13,
                'category_id' => 3,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            46 => 
            array (
                'product_id' => 13,
                'category_id' => 6,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            47 => 
            array (
                'product_id' => 13,
                'category_id' => 16,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            48 => 
            array (
                'product_id' => 13,
                'category_id' => 9,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            49 => 
            array (
                'product_id' => 13,
                'category_id' => 10,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            50 => 
            array (
                'product_id' => 14,
                'category_id' => 1,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
            51 => 
            array (
                'product_id' => 14,
                'category_id' => 3,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
            52 => 
            array (
                'product_id' => 14,
                'category_id' => 7,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
            53 => 
            array (
                'product_id' => 14,
                'category_id' => 9,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
            54 => 
            array (
                'product_id' => 14,
                'category_id' => 16,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
            55 => 
            array (
                'product_id' => 14,
                'category_id' => 10,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
        ));
        
        
    }
}