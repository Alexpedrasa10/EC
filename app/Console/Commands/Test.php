<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Helper;
use App\Models\UserCart;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Client;
use App\Services\ConvertApi;
use App\Services\ShippmentMethods\AndreaniApi;
use stdClass;

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
      $ship = new AndreaniApi();

      $bultos = array(
          array(
              'volumen' => 200,
              'kilos' => 0.3,
              'pesoAforado' => 1,
              'valorDeclarado' => 1200, // $1200
          ),
      );

      $orden = new stdClass();
      $orden->contrato = "400006709";
      $orden->tipoServicio = "Domicilio";

      $origen = new stdClass();

      $postalOrigen = new stdClass();
      $postalOrigen->codigoPostal = 5010;
      $postalOrigen->localidad = "Puerto Esperanza";
      $postalOrigen->region = "";
      $postalOrigen->calle = "AV. False";
      $postalOrigen->numero = 3080;

      $origen->postal = $postalOrigen;
      $orden->origen = $origen;

      $destino = new stdClass();
      
      $postalDestino = new stdClass();
      $postalDestino->codigoPostal = 9410;
      $postalDestino->localidad = "Puerto Esperanza";
      $postalDestino->region = "";
      $postalDestino->calle = "AV. False";
      $postalDestino->numero = 3080;

      $destino->postal = $postalDestino;
      $orden->destino = $destino;

      $remitente = new stdClass();
      $remitente->nombreCompleto = "Nombrre ashee";
      $remitente->documentoTipo = "DNI";
      $remitente->documentoNumero = 43888966;
      $remitente->email = "REMITENTE@GMAIL.COM";

      $fonoRemi = array();
      $tuboremi = new stdClass();
      $tuboremi->tipo = 1;
      $tuboremi->numero = 358596999;
      array_push($fonoRemi, $tuboremi);

      $remitente->telefonos = $fonoRemi;
      $orden->remitente = $remitente;

      $destinatario = new stdClass();
      $destinatario->nombreCompleto = "EL DESTINTARIO";
      $destinatario->documentoTipo = "DNI";
      $destinatario->documentoNumero = 43878966;
      $destinatario->email = "DESTINATARIO@GMAIL.COM";

      $fonoDest = array();
      $tubodest = new stdClass();
      $tubodest->tipo = 1;
      $tubodest->numero = 358596999;
      array_push($fonoDest, $tubodest);

      $destinatario->telefonos = $fonoDest;
      $orden->destinatario = $destinatario;

      $bultos = array();

      $bultos1 = new stdClass();
      $bultos1->kilos = 1.0;
      $bultos1->largoCm = 2.0;
      $bultos1->altoCm = 2.0;
      $bultos1->anchoCm = 2.0;
      $bultos1->volumenCm = 2.0;
      array_push($bultos, $bultos1);

      $orden->bultos = $bultos;



      // $price = $ship->consultPriceShippment(9410, $bultos);

      // $sucursal = $ship->getSucursalesByCP(9410);
      //dump($orden);
      $order = $ship->generateOrder($orden);
      dd($order);

    }
}
