<?php

namespace App\Models\Vaultody;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use function Termwind\ValueObjects\p;

abstract class VaultodyAbstract {

    protected static $query = [];
    protected static $body = [];

    protected static function reset() {
        static::$query = [];
        static::$body = [];
    }

    protected static function makeRequest() {

        $client = new Client();
        $timestamp = time();
        //convert timestamp to UTC
        $timestamp = $timestamp + date("Z",$timestamp);

        if(count(static::$body) < 1) {
            $body = '{}';
        }
        else {
            $body = json_encode(static::$body);
        }

        if(count(static::$query) < 1) {
            $query = '{}';
        }
        else {
            $query = json_encode(static::$query);
        }

        $signString = $timestamp . static::$method . static::$url . $body . $query;


        $secret = base64_decode(env('VAULTODY_API_SECRET'));
        $sign = base64_encode(
            hash_hmac('sha256', $signString, $secret, true)
        );

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => env('VAULTODY_API_KEY'),
                'x-api-sign' => $sign,
                'x-api-timestamp' => $timestamp,
                'x-api-passphrase' => env('VAULTODY_PASS_PHRASE'),

            ],
            'query' => static::$query,
        ];

        if(count(static::$body) > 0 && static::$method != 'GET') {
            //$params['body'] = json_encode(static::$body);
            $params['json'] = static::$body;
        }

        //dd($params);

        try {
            $res = $client->request(static::$method, env('VAULTODY_HOST') . static::$url, $params);
        }
        catch (RequestException  $e) {
            if ($e->hasResponse()) {
                return json_encode([
                    'response' => json_decode($e->getResponse()->getBody()->getContents(),true),
                    'status' => $e->getResponse()->getStatusCode()
                ]);
            } else {

                return json_encode([
                    'response' => $e->getMessage(),
                    'status' => $e->getResponse()->getStatusCode()
                ]);
            }
        }

        return json_encode([
            'response' => json_decode($res->getBody()->getContents()),
            'status' => $res->getStatusCode()
        ]);
    }

}
