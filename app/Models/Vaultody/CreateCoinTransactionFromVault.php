<?php

namespace App\Models\Vaultody;

class CreateCoinTransactionFromVault extends VaultodyAbstract {

    protected static $method = 'POST';
    protected static $url = '/wallet-as-a-service/wallets/{walletId}/{blockchain}/{network}/transaction-requests';

    public static function create(string $vaultId, string $blockchain, string $network, array $body) {
        static::reset();

        static::$body = $body;

        static::$url = str_replace(['{walletId}','{blockchain}','{network}'],[$vaultId, $blockchain, $network], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
