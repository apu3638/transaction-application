<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'transaction_id',
      'json_data',
      'api',
    ];
    public static function store($transactionId, $jsonData, $segment)
    {
        self::create([
            'transaction_id' => $transactionId,
            'json_data' => $jsonData,
            'api' => $segment,
        ]);
    }
}
