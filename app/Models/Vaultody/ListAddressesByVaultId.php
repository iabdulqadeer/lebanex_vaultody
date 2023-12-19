<?php

namespace App\Models\Vaultody;

class ListAddressesByVaultId extends VaultodyAbstract {

    protected static $method = 'GET';
    protected static $url = '/wallet-as-a-service/wallets/{vaultId}/{blockchain}/addresses';

    public static function get(string $vaultId, string $blockchain, int $limit = 50, string $startingAfter = '') {
        static::reset();
        static::$query['limit'] = (string)$limit;
        if($startingAfter != '') static::$query['startingAfter'] = (string)$startingAfter;

        static::$url = str_replace(['{vaultId}','{blockchain}'],[$vaultId, $blockchain], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
