<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id_cust';
    protected $keyType = 'string';
    protected $fillable = [
        'nama_cust',
        'telp_cust',
        'alamat_cust',
        'status',
    ];
}
