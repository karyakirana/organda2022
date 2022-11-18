<?php

namespace App\Models\Transaksi;

use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class STID extends Model
{
    use HasFactory;
    protected $table = 'stid';
    protected $primaryKey = 'id_stid';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_stid',
        'id_cust',
        'nopol',
        'kode',
        'masa_berlaku',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }
}
