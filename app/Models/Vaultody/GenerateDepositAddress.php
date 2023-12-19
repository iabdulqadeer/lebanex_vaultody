<?php

namespace App\Models\Vaultody;

class GenerateDepositAddress extends VaultodyAbstract {

    protected static $method = 'POST';
    protected static $url = '/wallet-as-a-service/wallets/{walletId}/{blockchain}/{network}/addresses';

    public static function generate(string $label, string $vaultId, string $blockchain, string $network) {
        static::reset();

        static::$body = [
            "data" => [
                "item" => [
                    "label" => (string)$label
                ]
            ]
        ];

        static::$url = str_replace(['{walletId}','{blockchain}','{network}'],[$vaultId, $blockchain, $network], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
