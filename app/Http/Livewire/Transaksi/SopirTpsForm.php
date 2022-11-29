<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Sopir;
use App\Models\Transaksi\TransaksiTPS;
use Livewire\Component;

class SopirTpsForm extends Component
{
    public $id_transaksitps;
    public $nik_tps;
    public $id_sopir, $nama_sopir;
    public $status;

    public $update = false;

    protected $listeners = [
        'setSopir'
    ];

    protected $rules = [
        'nama_sopir'=>'required',
        'nik_tps'=>'required'
    ];

    public function mount($id_transaksitps = null)
    {
        if ($id_transaksitps){
            $this->update = true;
            $query = TransaksiTPS::find($id_transaksitps);
            $this->id_transaksitps = $query->id_transaksitps;
            $this->nik_tps = $query->nik_tps;
            $this->id_sopir = $query->id_sopir;
            $this->nama_sopir = $query->sopir->nama_sopir;
        }
    }

    public function setSopir(Sopir $sopir)
    {
        $this->id_sopir = $sopir->id_sopir;
        $this->nama_sopir = $sopir->nama_sopir;
        $this->emit('modalSopirHide');
    }

    protected function kode()
    {
        $query = TransaksiTPS::latest('id_transaksitps')->first();
        if ($query){
            $lastnum = (int) substr($query->id_transaksitps, 3);
            $num = $lastnum + 1;
            return 'TPS'.sprintf('%05s', $num);
        }
        return 'TPS00001';
    }

    public function store()
    {
        $this->validate();
        $query = TransaksiTPS::create([
            'id_transaksitps' => $this->kode(),
            'id_sopir' => $this->id_sopir,
            'nik_tps' => $this->nik_tps,
            'status' => ''
        ]);
        session()->flash('message', 'Data '.$this->nama_sopir.' sudah di simpan.');
        return redirect()->to(route('tps'));
    }

    public function update()
    {
        $this->validate();
        $query = TransaksiTPS::find($this->id_transaksitps);
        $query->update([
            'id_sopir' => $this->id_sopir,
            'nik_tps' => $this->nik_tps,
        ]);
        // redirect
        session()->flash('message', 'Data '.$this->nama_sopir.' sudah di update.');
        return redirect()->to(route('tps'));
    }

    public function render()
    {
        return view('livewire.transaksi.sopir-tps-form');
    }
}
