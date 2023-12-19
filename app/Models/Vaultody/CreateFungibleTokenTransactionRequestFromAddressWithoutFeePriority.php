<?php

namespace App\Models\Vaultody;

class CreateFungibleTokenTransactionRequestFromAddressWithoutFeePriority extends VaultodyAbstract {

    protected static $method = 'POST';
    protected static $url = '/wallet-as-a-service/wallets/{walletId}/{blockchain}/{network}/addresses/{senderAddress}/feeless-token-transaction-requests';

    public static function create(string $vaultId, string $senderAddress, string $blockchain, string $network, array $body) {
        static::reset();

        static::$body = $body;

        static::$url = str_replace(['{walletId}','{blockchain}','{network}','{senderAddress}'],[$vaultId, $blockchain, $network, $senderAddress], static::$url);

        $request = static::makeRequest();
        return json_decode($request);
    }

}
