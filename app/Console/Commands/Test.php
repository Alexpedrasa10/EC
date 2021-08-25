<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Helper;
use App\Models\UserCart;
use App\Models\PhotoProduct;
use App\Models\Product;
use GuzzleHttp\Client;
use App\PaymentMethods\Bitcoin;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:app ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $product = Product::find(1);
        dump($product->photo()->first());
    }
}
