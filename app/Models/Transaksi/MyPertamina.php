<?php

namespace App\Models\Transaksi;

use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPertamina extends Model
{
    use HasFactory;
    protected $table = 'transaksi_mypertamina';
    protected $primaryKey = 'id_mypertamina';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id_mypertamina',
        'id_cust',
        'nopol',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }
}
