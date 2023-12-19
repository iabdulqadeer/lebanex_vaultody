<?php

namespace App\Models\Vaultody;

class ListVaults extends VaultodyAbstract {

    protected static $method = 'GET';
    protected static $url = '/wallet-as-a-service/vaults';

    public static function get(int $limit = 50, string $startingAfter = '') {
        static::reset();
        static::$query['limit'] = (string)$limit;
        if($startingAfter != '') static::$query['startingAfter'] = (string)$startingAfter;

        $request = static::makeRequest();
        return json_decode($request);
    }

}
