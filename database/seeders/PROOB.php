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

        $categoriesMen = new stdClass;
        $categoriesMen->categories = array(1, 3);

        $categorieswomen = new stdClass;
        $categorieswomen->categories = array(2, 4);

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
            'description' => 'Sudadera de algodon hecho en India bajo explotación infantil. Producto línea nueva de la colección 24/5.',
            'stock' => 10,
            'price' => 250.00,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/44e87f9c-b9e7-431e-9301-971b1b0b1c79/sudadera-con-capucha-de-entrenamiento-sin-cierre-con-swoosh-therma-tvzGsr.png",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Gucci',
            'slug' => 'PantalonGucci',
            'description' => 'Pantalón de piel de cocodrilo, cazado por las manos de Putin. Colección Summer 2021/2022. Diseñado por Martin Pride en colaboración con Louis Viuotton.',
            'stock' => 10,
            'price' => 450.00,
            'sale_price' => 299.99,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://i.pinimg.com/originals/50/ae/05/50ae051db59c31c345414128cddf6536.png",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'Campera abrigada línea Air Jordan en colaboración con Paris Saint-Germain. Indumentaria oficial para los partidos disputador por la UEFA Champions League. ',
            'stock' => 10,
            'price' => 999.99,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://www.digitalsport.com.ar/files/products/5f557387e2d01-497640-1200x1200.jpg",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Sudadera Puma',
            'slug' => 'SudaderaPuma',
            'description' => 'Campera Puma, importado desde Alemania. Tela suave y abrigada para salir a hacer deporte.',
            'stock' => 10,
            'price' => 480.00,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://s.fenicio.app/f/menpuy/catalogo/articulos/58349702-0-1_1920-1200_1599859491_301.jpg",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Remera Gucci',
            'slug' => 'RemeraGucci',
            'description' => 'Remera Gucci colección Summer 2017, en colaboración con Adidas.',
            'stock' => 10,
            'price' => 450.00,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://cdn.fs.grailed.com/api/file/LuTZ0DYBS5WOGOaueMj7",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera NorthFace',
            'slug' => 'CamperaNorthFace',
            'description' => 'Campera para que puedas subir hasta al monte Everest.',
            'stock' => 10,
            'price' => 799.99,
            'sale_price' => 499.99,
            'category' => json_encode($categoriesMen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://http2.mlstatic.com/D_NQ_NP_941295-MLA45528807185_042021-W.jpg",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Musculosa Nike',
            'slug' => 'MusculosaNike',
            'description' => 'Musculosa Nike importada de Francia, diseñadada por Louis Vuoton y Givenchy.',
            'stock' => 10,
            'price' => 179.99,
            'category' => json_encode($categoriesMen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://ferreira.vteximg.com.br/arquivos/ids/303709-1000-1000/ni_aq5591010.jpg?v=636983668533930000",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Kappa',
            'slug' => 'PantalonKappa',
            'description' => 'En colaboración con Gucci, llegan estos pantalones pertenecientes a la colección winter 21.',
            'stock' => 10,
            'price' => 420.00,
            'category' => json_encode($categoriesMen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://ferreira.vteximg.com.br/arquivos/ids/367714-1000-1000/KA_3014QS0AD5.jpg?v=637456341596930000U",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Adidas',
            'slug' => 'CamperaAdidas',
            'description' => 'Campera adidas en colaboracion con Messi.',
            'stock' => 10,
            'price' => 999.99,
            'sale_price' => 599.99,
            'category' => json_encode($categoriesMen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://i.pinimg.com/originals/ce/a0/d5/cea0d5347fda31ef64cb2a7c5e5410d1.png",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Gorro Gucci',
            'slug' => 'GorroGucci',
            'description' => 'Gorro gucci con toda la onda ansheee.',
            'stock' => 10,
            'price' => 550.00,
            'category' => json_encode($categorieswomen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://images.lvrcdn.com/Big70I/H0L/047_b0f917df-72dd-48d3-a14e-282eb43ad3ae.JPG",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Camisa Burberry',
            'slug' => 'CamisaBurberry',
            'description' => 'Colección winter 2021/22 en colaboración de Ñengo Flow y Myke Towers.',
            'stock' => 10,
            'price' => 1999.99,
            'category' => json_encode($categoriesMen),
            'data' => json_encode($allSizes),
            'url_photos' => "https://images.ikrix.com/product_images/original/burberry-shirts-patchwork-check-and-logo-shirt-in-beige-00000226737f00s001.jpg",
            'is_active' => 1
        ]);
    }
}
