<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    protected $primaryKey = 'stock_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['stock_code', 'stock_name', 'shared', 'sektor'];

    public function transaksiHarians()
    {
        return $this->hasMany(TransaksiHarian::class, 'stock_code', 'stock_code');
    }
}
