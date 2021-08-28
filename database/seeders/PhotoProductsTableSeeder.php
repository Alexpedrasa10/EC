<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhotoProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('photo_products')->delete();
        
        \DB::table('photo_products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'filename' => 'DVipvE9T7O5i56y70HKawWvcjoSIqhVqs2YCQI77.jpg',
                'url' => 'https://www.dropbox.com/s/anvdrmmskznl0eq/DVipvE9T7O5i56y70HKawWvcjoSIqhVqs2YCQI77.jpg?dl=0',
                'product_id' => 1,
                'created_at' => '2021-08-24 23:52:08',
                'updated_at' => '2021-08-24 23:52:08',
            ),
            1 => 
            array (
                'id' => 2,
                'filename' => 'RQQzzHgxsJgl1sILLos9NlMp6jJmS4lgHX2djEoT.jpg',
                'url' => 'https://www.dropbox.com/s/r7lqzr2vhxyeg3w/RQQzzHgxsJgl1sILLos9NlMp6jJmS4lgHX2djEoT.jpg?dl=0',
                'product_id' => 2,
                'created_at' => '2021-08-24 23:52:44',
                'updated_at' => '2021-08-24 23:52:44',
            ),
            2 => 
            array (
                'id' => 3,
                'filename' => 'xz1VSzUoyO1fKCIyVC3CCz20t6kxfwO4SAExupq7.jpg',
                'url' => 'https://www.dropbox.com/s/ut638k0icp78ukt/xz1VSzUoyO1fKCIyVC3CCz20t6kxfwO4SAExupq7.jpg?dl=0',
                'product_id' => 3,
                'created_at' => '2021-08-24 23:53:04',
                'updated_at' => '2021-08-24 23:53:04',
            ),
            3 => 
            array (
                'id' => 4,
                'filename' => 'zDLm0Vxk4p36EZBVz8TMTivF9qypJ4YfrgnoT5ZV.jpg',
                'url' => 'https://www.dropbox.com/s/pps5lk3jtbqp8iv/zDLm0Vxk4p36EZBVz8TMTivF9qypJ4YfrgnoT5ZV.jpg?dl=0',
                'product_id' => 4,
                'created_at' => '2021-08-24 23:53:18',
                'updated_at' => '2021-08-24 23:53:18',
            ),
            4 => 
            array (
                'id' => 5,
                'filename' => 'wikoqqPuFPxnGkmwKpIsuBUAKSZ4YryWOatRF8Jh.jpg',
                'url' => 'https://www.dropbox.com/s/z2awesoujrbfu3q/wikoqqPuFPxnGkmwKpIsuBUAKSZ4YryWOatRF8Jh.jpg?dl=0',
                'product_id' => 5,
                'created_at' => '2021-08-24 23:53:34',
                'updated_at' => '2021-08-24 23:53:34',
            ),
            5 => 
            array (
                'id' => 6,
                'filename' => 'ZTvBFDMXUAVOZLNqdRXW3RgfR6eVgTJGciltIzLA.jpg',
                'url' => 'https://www.dropbox.com/s/kb02sfl0mb44slt/ZTvBFDMXUAVOZLNqdRXW3RgfR6eVgTJGciltIzLA.jpg?dl=0',
                'product_id' => 6,
                'created_at' => '2021-08-24 23:53:54',
                'updated_at' => '2021-08-24 23:53:54',
            ),
            6 => 
            array (
                'id' => 7,
                'filename' => '9DR3i2Dtpe5IgCJ9VmzqBNSb49MZSF7WdJlDqxWs.jpg',
                'url' => 'https://www.dropbox.com/s/rmg0trhlvq1h7mi/9DR3i2Dtpe5IgCJ9VmzqBNSb49MZSF7WdJlDqxWs.jpg?dl=0',
                'product_id' => 7,
                'created_at' => '2021-08-24 23:54:16',
                'updated_at' => '2021-08-24 23:54:16',
            ),
            7 => 
            array (
                'id' => 8,
                'filename' => 'dHrL85yrOUx22hRhXXiysWaz6CfVE7dgjl0mX9zx.jpg',
                'url' => 'https://www.dropbox.com/s/f3hpdz865csrba5/dHrL85yrOUx22hRhXXiysWaz6CfVE7dgjl0mX9zx.jpg?dl=0',
                'product_id' => 8,
                'created_at' => '2021-08-24 23:54:44',
                'updated_at' => '2021-08-24 23:54:44',
            ),
            8 => 
            array (
                'id' => 9,
                'filename' => '7cI4UMwz2dUjCdtyZDUuDJdzrv9WcJLkfYrXdSZL.jpg',
                'url' => 'https://www.dropbox.com/s/ghsnpi3czhg8fnk/7cI4UMwz2dUjCdtyZDUuDJdzrv9WcJLkfYrXdSZL.jpg?dl=0',
                'product_id' => 9,
                'created_at' => '2021-08-24 23:55:44',
                'updated_at' => '2021-08-24 23:55:44',
            ),
            9 => 
            array (
                'id' => 10,
                'filename' => 'ENrdASa643pnjr8W5zRvwiGJsfvc2FN6vypyyJdU.jpg',
                'url' => 'https://www.dropbox.com/s/jec48xwt0p7kb3x/ENrdASa643pnjr8W5zRvwiGJsfvc2FN6vypyyJdU.jpg?dl=0',
                'product_id' => 10,
                'created_at' => '2021-08-24 23:56:14',
                'updated_at' => '2021-08-24 23:56:14',
            ),
            10 => 
            array (
                'id' => 11,
                'filename' => 'sRSsvyMRAbssIG1RMAnE0rSIQCA68oVNcZXEWIRd.jpg',
                'url' => 'https://www.dropbox.com/s/tszxshtbslg7xn8/sRSsvyMRAbssIG1RMAnE0rSIQCA68oVNcZXEWIRd.jpg?dl=0',
                'product_id' => 11,
                'created_at' => '2021-08-24 23:56:30',
                'updated_at' => '2021-08-24 23:56:30',
            ),
            11 => 
            array (
                'id' => 12,
                'filename' => '03j8qzYpiIhI49DoLcvXCnQbq6fUse9dni12g4Pu.jpg',
                'url' => 'https://www.dropbox.com/s/oa7mkretqjncgg0/03j8qzYpiIhI49DoLcvXCnQbq6fUse9dni12g4Pu.jpg?dl=0',
                'product_id' => 12,
                'created_at' => '2021-08-28 00:18:36',
                'updated_at' => '2021-08-28 00:18:36',
            ),
            12 => 
            array (
                'id' => 13,
                'filename' => '8948WvhH57ApObbVglBFJqLaXmdFpi6cUQl7dAyq.jpg',
                'url' => 'https://www.dropbox.com/s/5sjqitq02c22c6s/8948WvhH57ApObbVglBFJqLaXmdFpi6cUQl7dAyq.jpg?dl=0',
                'product_id' => 13,
                'created_at' => '2021-08-28 19:48:37',
                'updated_at' => '2021-08-28 19:48:37',
            ),
            13 => 
            array (
                'id' => 14,
                'filename' => '22D5ohaaPVXCZMLkYs89AwIeXMP648TGqUCIQv7l.jpg',
                'url' => 'https://www.dropbox.com/s/tykiosom28w229o/22D5ohaaPVXCZMLkYs89AwIeXMP648TGqUCIQv7l.jpg?dl=0',
                'product_id' => 14,
                'created_at' => '2021-08-28 20:02:34',
                'updated_at' => '2021-08-28 20:02:34',
            ),
        ));
        
        
    }
}