<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//VAULTODY ENDPOINS Examples

//return all available blockchains and networks
Route::get('/list-blockchains', function () {
    dd(\App\Models\Vaultody\Blockchains::get());
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/informative/list-vaults
Route::get('/list-vaults', function () {
    dd(\App\Models\Vaultody\ListVaults::get());
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/generating/generate-deposit-address
Route::get('/generate-deposit-address', function () {
    dd(\App\Models\Vaultody\GenerateDepositAddress::generate('My Address','648c24d51cfbcd0007735564','bitcoin','testnet'));
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/informative/list-addresses-by-vault-and-blockchain
Route::get('/list-addresses-by-vaultid', function () {
    dd(\App\Models\Vaultody\ListAddressesByVaultId::get('648c24d51cfbcd0007735564','bitcoin'));
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/informative/list-assets-by-address
Route::get('/list-addresses-by-address', function () {
    dd(\App\Models\Vaultody\ListAddressesByAddress::get('648c24d51cfbcd0007735564','bitcoin','tb1qxfntqjnuq2pl50uffpgnhfkc7ant4ykx3mq22z'));
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/transactions/create-coins-transaction-request-from-vault
Route::get('/create-coin-transaction-request-from-vault', function () {

    $blockchain = 'bitcoin';
    $network = 'testnet';
    $vaultId = '648c24d51cfbcd0007735564';

    $transactionData = [
        "context" => "yourExampleString",
        "data" =>  [
            "item" => [
                "feePriority" => "standard",
                "note" => "yourAdditionalInformationhere",
                "prepareStrategy" => "minimize-dust",
                "recipients" => [
                    (object)[
                        "address" => "2MtzNEqm2D9jcbPJ5mW7Z3AUNwqt3afZH66",
                        "amount" => "0.125"
                    ]
                ]
            ]
        ]
    ];


    //send transaction
    $transaction = \App\Models\Vaultody\CreateCoinTransactionFromVault::create($vaultId,$blockchain,$network, $transactionData);
    //create tx log
    \App\Models\Vaultody\TransactionLog::create([
        'transaction_type' => 'create-coin-transaction-request-from-vault',
        'request' => json_encode(array_merge(['vaultId' => $vaultId,'blockchain' => $blockchain,'network' => $network], $transactionData)),
        'response' => json_encode($transaction->response),
        'status_code' => $transaction->status
    ]);
    dd($transaction);
});

//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/transactions/create-coins-transaction-request-from-address
Route::get('/create-coin-transaction-request-from-address', function () {


    $blockchain = 'ethereum';
    $network = 'goerli';
    $vaultId = '648c24d51cfbcd0007735564';
    $address = '0xc6d46aba0c6e2eb6358c4e24804158cc4d847922';


    $transactionData = [
        "context" => "yourExampleString",
        "data" =>  [
            "item" => [
                "amount" => "0.2",
                "feePriority" => "slow",
                "note" => "yourAdditionalInformationhere",
                "recipientAddress" => "0xc6d46aba0c6e2eb6358c4e24804158cc4d847922"
            ]
        ]
    ];

    //send transaction
    $transaction = \App\Models\Vaultody\CreateCoinTransactionFromAddress::create($vaultId,$address,$blockchain,$network, $transactionData);
    //create tx log
    \App\Models\Vaultody\TransactionLog::create([
        'transaction_type' => 'create-coin-transaction-request-from-address',
        'request' => json_encode(array_merge(['vaultId' => $vaultId,'blockchain' => $blockchain,'network' => $network,'address' => $address], $transactionData)),
        'response' => json_encode($transaction->response),
        'status_code' => $transaction->status
    ]);
    dd($transaction);
});



//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/transactions/create-fungible-tokens-transaction-request-from-address
Route::get('/create-fungible-tokens-transaction-request-from-address', function () {


    $blockchain = 'ethereum';
    $network = 'goerli';
    $vaultId = '648c24d51cfbcd0007735564';
    $address = '0xc6d46aba0c6e2eb6358c4e24804158cc4d847922';

    $transactionData = [
        "context" => "yourExampleString",
        "data" =>  [
            "item" => [
                "amount" => "0.2",
                "feePriority" => "standard",
                "note" => "yourAdditionalInformationhere",
                "recipientAddress" => "0xc6d46aba0c6e2eb6358c4e24804158cc4d847922",
                "tokenIdentifier" => "0xdac17f958d2ee523a2206206994597c13d831ec7"
            ]
        ]
    ];

    //send transaction
    $transaction = \App\Models\Vaultody\CreateFungibleTokensTransactionRequestFromAddress::create($vaultId,$address,$blockchain,$network, $transactionData);
    //create tx log
    \App\Models\Vaultody\TransactionLog::create([
        'transaction_type' => 'create-fungible-tokens-transaction-request-from-address',
        'request' => json_encode(array_merge(['vaultId' => $vaultId,'blockchain' => $blockchain,'network' => $network,'address' => $address], $transactionData)),
        'response' => json_encode($transaction->response),
        'status_code' => $transaction->status
    ]);
    dd($transaction);
});


//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/transactions/create-single-transaction-request-from-address-without-fee-priority
Route::get('/create-single-transaction-request-from-address-without-fee-priority', function () {


    $blockchain = 'tron';
    $network = 'nile';
    $vaultId = '648c24d51cfbcd0007735564';
    //sender address
    $address = 'TMVeigwYyuXJVHER4oA2yQzsFFSN2JfXkt';

    $transactionData = [
        "context" => "yourExampleString",
        "data" =>  [
            "item" => [
                "amount" => "0.0006",
                "note" => "yourAdditionalInformationhere",
                "recipientAddress" => "TMVeigwYyuXJVHER4oA2yQzsFFSN2JfXkt"
            ]
        ]
    ];

    //send transaction
    $transaction = \App\Models\Vaultody\CreateSingleTransactionRequestFromAddressWithoutFeePriority::create($vaultId,$address,$blockchain,$network, $transactionData);
    //create tx log
    \App\Models\Vaultody\TransactionLog::create([
        'transaction_type' => 'create-single-transaction-request-from-address-without-fee-priority',
        'request' => json_encode(array_merge(['vaultId' => $vaultId,'blockchain' => $blockchain,'network' => $network,'address' => $address], $transactionData)),
        'response' => json_encode($transaction->response),
        'status_code' => $transaction->status
    ]);
    dd($transaction);
});


//https://developers.vaultody.com/technical-documentation/api/wallet-as-a-service/transactions/create-fungible-token-transaction-request-from-address-without-fee-priority
Route::get('/create-fungible-token-transaction-request-from-address-without-fee-priority', function () {


    $blockchain = 'tron';
    $network = 'nile';
    $vaultId = '648c24d51cfbcd0007735564';
    //sender address
    $address = 'TMVeigwYyuXJVHER4oA2yQzsFFSN2JfXkt';

    $transactionData = [
        "context" => "yourExampleString",
        "data" =>  [
            "item" => [
                "amount" => "0.25684",
                "feeLimit" => "1000000000",
                "note" => "yourAdditionalInformationhere",
                "recipientAddress" => "TMVeigwYyuXJVHER4oA2yQzsFFSN2JfXkt",
                "tokenIdentifier" =>  "TF17BgPaZYbz8oxbjhriubPDsA7ArKoLX3"
            ]
        ]
    ];

    //send transaction
    $transaction = \App\Models\Vaultody\CreateFungibleTokenTransactionRequestFromAddressWithoutFeePriority::create($vaultId,$address,$blockchain,$network, $transactionData);
    //create tx log
    \App\Models\Vaultody\TransactionLog::create([
        'transaction_type' => 'create-fungible-token-transaction-request-from-address-without-fee-priority',
        'request' => json_encode(array_merge(['vaultId' => $vaultId,'blockchain' => $blockchain,'network' => $network,'address' => $address], $transactionData)),
        'response' => json_encode($transaction->response),
        'status_code' => $transaction->status
    ]);
    dd($transaction);
});

//END Vaultody examples


//Callbacks cacher

Route::post('/callbacks/vaultody', [\App\Http\Controllers\VaultodyCallback::class, 'index']);


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
