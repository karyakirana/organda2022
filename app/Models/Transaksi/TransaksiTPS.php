<?php

namespace App\Models\Transaksi;

use App\Models\Master\Sopir;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTPS extends Model
{
    use HasFactory;
    protected $table = 'transaksi_tps';
    protected $keyType = 'string';
    protected $primaryKey = 'id_transaksitps';
    public $timestamps = false;
    protected $fillable = [
        'id_transaksitps',
        'nik_tps',
        'id_sopir',
        'status'
    ];

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_sopir');
    }
}
