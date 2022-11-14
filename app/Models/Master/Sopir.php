<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    use HasFactory;
    protected $table = 'sopir';
    protected $primaryKey = 'id_sopir';
    protected $keyType = 'string';

    protected $fillable = [
        'id_card',
        'id_cust',
        'nama_sopir',
        'telp_sopir',
        'ktp_sopir',
        'sim_sopir',
        'alamat_sopir',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }
}
