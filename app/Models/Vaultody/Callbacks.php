<?php

namespace App\Models\Vaultody;

use Illuminate\Database\Eloquent\Model;

class Callbacks extends Model {

    protected $table = 'callbacks_log';
    protected $fillable = [
        'callback_content',
    ];

}
