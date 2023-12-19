<?php

namespace App\Models\Vaultody;

class CreateFungibleTokensTransactionRequestFromAddress extends VaultodyAbstract {

    protected static $method = 'POST';
    protected static $url = '/wallet-as-a-service/wallets/{walletId}/{blockchain}/{network}/addresses/{address}/feeless-transaction-requests';

    public static function create(string $vaultId, string $address, string $blockchain, string $network, array $body) {
        static::reset();

        static::$body = $body;

        static::$url = str_replace(['{walletId}','{blockchain}','{network}','{address}'],[$vaultId, $blockchain, $network, $address], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
