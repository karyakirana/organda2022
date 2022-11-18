<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Customer;
use App\Models\Master\Mobil;
use Livewire\Component;

class MobilForm extends Component
{
    public $id_mobil;
    public $id_cust, $nama_cust;
    public $jenis_mobil;
    public $nopol_mobil;
    public $status;

    public $update = false;

    protected $listeners = [
        'setCustomer'
    ];

    public function mount($idMobil = null)
    {
        if ($idMobil){
            $this->update = true;
            $mobil = Mobil::find($idMobil);
            //dd($mobil);
            $this->id_mobil = $mobil->id_mobil;
            $this->id_cust = $mobil->id_cust;
            $this->nama_cust = $mobil->customer->nama_cust;
            $this->jenis_mobil = $mobil->jenis_mobil;
            $this->nopol_mobil = $mobil->nopol_mobil;
        }
    }

    public function setCustomer(Customer $customer)
    {
        $this->id_cust = $customer->id_cust;
        $this->nama_cust = $customer->nama_cust;
        $this->emit('modalCustomerHide');
    }

    public function kode()
    {
        $query = Mobil::latest('id_mobil')->first();
        if ($query){
            $lastnum = (int) substr($query->id_mobil, 3);
            $num = $lastnum + 1;
            return 'KDR'.sprintf('%05s', $num);
        }
        return 'KDR00001';
    }

    public function store()
    {
        $this->validate([
            'nama_cust'=>'required',
            'jenis_mobil'=>'required',
            'nopol_mobil'=>'required'
        ]);
        $mobil = new Mobil;
        $mobil->id_mobil = $this->kode();
        $mobil->id_cust = $this->id_cust;
        $mobil->jenis_mobil = $this->jenis_mobil;
        $mobil->nopol_mobil = $this->nopol_mobil;
        $mobil->status = '';
        $mobil->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_mobil.' sudah disimpan.');
        return redirect()->to(route('mobil'));
    }

    public function update()
    {
        $this->validate([
            'nama_cust'=>'required',
            'jenis_mobil'=>'required',
            'nopol_mobil'=>'required'
        ]);
        $mobil = Mobil::find($this->id_mobil);
        $mobil->id_cust = $this->id_cust;
        $mobil->jenis_mobil = $this->jenis_mobil;
        $mobil->nopol_mobil = $this->nopol_mobil;
        $mobil->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_mobil.' sudah di update.');
        return redirect()->to(route('mobil'));
    }

    public function render()
    {
        return view('livewire.master.mobil-form');
    }
}
