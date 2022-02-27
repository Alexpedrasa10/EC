<?php

trait ExchangeAuth 
{
    public function getNonce () :string
    {
        list($msec, $sec) = explode(' ', microtime());
        return $sec . substr($msec, 2, 3);
    }

    /**
     * Método para autenticarse a la API de Buda
     * @param string $method
     * @param string $path
     * @param string $nonce
     * @param string $body
     * @return mixed     * 
     */
    public function getSign(string $method, string $path, string $nonce, string $body = null)
    {
        $components = [$method, $path];

        if (!is_null($body)) $components[] = base64_encode($body);

        $components[] = $nonce;
        $msg = implode(" ", $components);

        return hash_hmac("sha384", $msg, $this->secret);
    }
}