<?php

namespace App\Services\ShippmentMethods;

use Helper;
use stdClass;
use AlejoASotelo\Andreani;
use App\Models\User;

class AndreaniApi
{
    private $apiContext, $andreaniConfig;

    public function __construct()
    {
        // Set Connection
        $this->andreaniConfig = config("shippment-methods.andreani");
        $isDebug = env('APP_DEBUG', false);

        $this->apiContext = new Andreani(
            $this->andreaniConfig['user'],
            $this->andreaniConfig['pwd'],
            $this->andreaniConfig['client'],
            $isDebug
        );
    }

    public function generateOrder ($order)
    {
        $contrato = $this->andreaniConfig['contract_envio'];

        // Datos de ejemplo obtenidos de https://developers.andreani.com/documentacion/2#crearOrden
        $data = [
            'contrato' => $this->andreaniConfig['contract_envio'],
            'origen' => [
                'postal' => [
                    'codigoPostal' => '3378',
                    'calle' => 'Av Falsa',
                    'numero' => '380',
                    'localidad' => 'Puerto Esperanza',
                    'region' => '',
                    'pais' => 'Argentina',
                    'componentesDeDireccion' => [
                        [
                            'meta' => 'entreCalle',
                            'contenido' => 'Medina y Jualberto',
                        ],
                    ],
                ],
            ],
            'destino' => [
              'postal' => [
                'codigoPostal' => '1292',
                'calle' => 'Macacha Guemes',
                'numero' => '28',
                'localidad' => 'C.A.B.A.',
                'region' => 'AR-B',
                'pais' => 'Argentina',
                'componentesDeDireccion' => [
                  [
                    'meta' => 'piso',
                    'contenido' => '2',
                  ],
                  [
                    'meta' => 'departamento',
                    'contenido' => 'B',
                  ],
                ],
              ],
            ],
            'remitente' => [
              'nombreCompleto' => 'Alberto Lopez',
              'email' => 'remitente@andreani.com',
              'documentoTipo' => 'DNI',
              'documentoNumero' => '33111222',
              'telefonos' => [
                [
                  'tipo' => 1,
                  'numero' => '113332244',
                ],
              ],
            ],
            'destinatario' => [
                [
                    'nombreCompleto' => 'Juana Gonzalez',
                    'email' => 'destinatario@andreani.com',
                    'documentoTipo' => 'DNI',
                    'documentoNumero' => '33999888',
                    'telefonos' => [
                        [
                            'tipo' => 1,
                            'numero' => '1112345678',
                        ],
                    ],
                ],
            ],
            'productoAEntregar' => 'Aire Acondicionado',
            'bultos' => [
                [
                    'kilos' => 2,
                    'largoCm' => 10,
                    'altoCm' => 50,
                    'anchoCm' => 10,
                    'volumenCm' => 5000,
                    'valorDeclaradoSinImpuestos' => 1200,
                    'valorDeclaradoConImpuestos' => 1452,
                    'referencias' => [
                        [
                            'meta' => 'detalle',
                            'contenido' => 'Secador de pelo',
                        ]
                    ],
                ],
            ],
        ];
        
        ### 1. Cotizar el envío ###
        $codigoPostal = $data['destino']['postal']['codigoPostal'];
        
        $cotizacion = $this->apiContext->cotizarEnvio($codigoPostal, $contrato, $data['bultos']);
        
        if (is_null($cotizacion)) {
            die('1. (!) No se pudo obtener la Cotización.');
        }
        
        file_put_contents(__DIR__.'/procesoDeEnvio-1-cotizarEnvio.json', json_encode($cotizacion));
        
        
        ### 2. Crear la Orden ###
        $orden = $this->apiContext->addOrden($data);
        
        if (is_null($orden)) {
            die('2. (!) No se pudo crear la Orden.');
        }
        
        file_put_contents(__DIR__.'/procesoDeEnvio-2-addOrden.json', json_encode($orden));
        dump($orden);
    }

    public function consultPriceShippment (int $cp, array $bultos, int $sucursalOrigen = null)
    {
        $response = $this->apiContext->cotizarEnvio(
            $cp,
            $this->andreaniConfig['contract_envio'],
            $bultos,
            $this->andreaniConfig['client'],
            $sucursalOrigen
        );

        if (!is_null($response)) {
            
            $priceShippment = $response->tarifaConIva->total;
            return $priceShippment;
        }
    }

    public function getSucursalesByCP (int $cp)
    {
        return $this->apiContext->getSucursalByCodigoPostal($cp);
    }


}