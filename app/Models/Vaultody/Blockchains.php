<?php

namespace App\Models\Vaultody;

class Blockchains {

    public static function get() {
        return [
            0 => [
                'blockchain' => 'bitcoin',
                'networks' => [
                    'mainnet',
                    'testnet'
                ]
            ],
            1 => [
                'blockchain' => 'ethereum',
                'networks' => [
                    'mainnet',
                    'goerli'
                ]
            ],
            2 => [
                'blockchain' => 'dogecoin',
                'networks' => [
                    'mainnet',
                    'testnet'
                ]
            ],
            3 => [
                'blockchain' => 'xrp',
                'networks' => [
                    'mainnet',
                    'testnet'
                ]
            ],
            4 => [
                'blockchain' => 'binance-smart-chain',
                'networks' => [
                    'mainnet',
                    'testnet'
                ]
            ],
            5 => [
                'blockchain' => 'tron',
                'networks' => [
                    'mainnet',
                    'nile'
                ]
            ]
        ];
    }
}
