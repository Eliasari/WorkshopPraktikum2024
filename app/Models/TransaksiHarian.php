<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHarian extends Model
{
    protected $primaryKey = 'no_records';

    protected $fillable = ['stock_code', 'date_transaction', 'open', 'high', 'low', 'close', 'change', 'volume', 'value', 'frequency'];

    public function emiten()
    {
        return $this->belongsTo(Emiten::class, 'stock_code', 'stock_code');
    }
}
