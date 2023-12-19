<?php

namespace App\Models\Vaultody;

class ListAddressesByAddress extends VaultodyAbstract {

    protected static $method = 'GET';
    protected static $url = '/vaults/{vaultId}/{blockchain}/addresses/{address}/assets';

    public static function get(string $vaultId, string $blockchain, string $address) {
        static::reset();
        static::$url = str_replace(['{vaultId}','{blockchain}','{address}'],[$vaultId, $blockchain, $address], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
