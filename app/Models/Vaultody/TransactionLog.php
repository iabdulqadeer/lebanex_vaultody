<?php

namespace App\Models\Vaultody;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model {

    protected $table = 'transactions_log';
    protected $fillable = [
        'transaction_type',
        'request',
        'response',
        'status_code'
    ];

}
