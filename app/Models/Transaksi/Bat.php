<?php

namespace App\Models\Transaksi;

use App\Models\Master\Customer;
use App\Models\Master\Mobil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bat extends Model
{
    use HasFactory;
    protected $table = 'transaksi_bat';
    protected $primaryKey = 'id_bat';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_bat',
        'id_cust',
        'id_mobil',
        'no_bat',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id_mobil');
    }
}
