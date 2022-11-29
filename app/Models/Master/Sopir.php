<?php

namespace App\Models\Master;

use App\Models\Transaksi\Lamong;
use App\Models\Transaksi\TransaksiTPS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    use HasFactory;
    protected $table = 'sopir';
    protected $primaryKey = 'id_sopir';
    protected $keyType = 'string';
    public $timestamps = false;

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

    public function transaksiTps()
    {
        return $this->hasOne(TransaksiTPS::class, 'id_sopir', 'id_sopir');
    }

    public function transaksiLamong()
    {
        return $this->hasOne(Lamong::class, 'id_sopir', 'id_sopir');
    }
}
