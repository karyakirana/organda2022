<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Sopir;
use Livewire\Component;

class SopirDetail extends Component
{
    public $id_sopir;
    public $id_cust, $nama_cust;
    public $nama_sopir;
    public $telp_sopir;
    public $ktp_sopir, $sim_sopir;
    public $alamat_sopir;
    public $status;

    protected $listeners = [
        'loadDetail',
        'resetForm',
    ];

    public function loadDetail($idSopir = null)
    {
        if ($idSopir){
            $sopir = Sopir::find($idSopir);
            $this->id_sopir = $sopir->id_sopir;
            $this->id_cust = $sopir->id_cust;
            $this->nama_sopir = $sopir->nama_sopir;
            $this->nama_cust = $sopir->customer->nama_cust;
            $this->telp_sopir = $sopir->telp_sopir;
            $this->ktp_sopir = $sopir->ktp_sopir;
            $this->sim_sopir = $sopir->sim_sopir;
            $this->alamat_sopir = $sopir->alamat_sopir;
            $this->status = $sopir->status;
        }
        $this->emit('detailShow');
    }

    public function resetForm()
    {
        $this->reset([
            'id_cust', 'id_sopir', 'nama_cust', 'ktp_sopir', 'sim_sopir', 'alamat_sopir', 'status'
        ]);
    }

    public function render()
    {
        return view('livewire.master.sopir-detail');
    }
}
