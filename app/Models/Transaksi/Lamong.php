<?php

namespace App\Models\Transaksi;

use App\Models\Master\Customer;
use App\Models\Master\Sopir;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamong extends Model
{
    use HasFactory;
    protected $table = 'transaksi_lamong';
    protected $primaryKey = 'id_translamong';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_translamong',
        'id_cust',
        'id_sopir',
        'nik_lamong',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_sopir', 'id_sopir');
    }
}
