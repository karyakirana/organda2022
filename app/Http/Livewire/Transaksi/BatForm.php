<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Customer;
use App\Models\Master\Mobil;
use App\Models\Transaksi\Bat;
use Livewire\Component;

class BatForm extends Component
{
    public $id_bat;
    public $id_cust, $nama_cust;
    public $id_mobil, $nopol;
    public $no_bat;
    public $tanggal_bat;
    public $status;

    public $update = false;

    protected $listeners = [
        'setCustomer',
        'setMobil'
    ];

    public function mount($id_bat = null)
    {
        if ($id_bat){
            $this->update = true;
            $bat = Bat::find($id_bat);

        }
    }

    public function setCustomer(Customer $customer)
    {
        $this->id_cust = $customer->id_cust;
        $this->nama_cust = $customer->nama_cust;
        $this->emit('modalCustomerHide');
    }

    public function setMobil(Mobil $mobil)
    {
        $this->id_mobil = $mobil->id_mobil;
        $this->nopol = $mobil->nopol_mobil;
        $this->emit('modalMobilHide');
    }

    public function kode()
    {
        $query = Bat::latest('id_bat')->first();
        if ($query){
            $lastnum = (int) substr($query->id_bat, 3);
            $num = $lastnum + 1;
            return 'BAT'.sprintf('%05s', $num);
        }
        return 'BAT00001';
    }

    public function store()
    {
        $this->validate([
            'nama_cust'=>'required',
            'nopol'=>'required',
            'no_bat'=>'required',
            'tanggal_bat'=>'required'
        ]);
        $bat = new Bat;
        $bat->id_bat = $this->kode();
        $bat->id_cust = $this->id_cust;
        $bat->id_mobil = $this->id_mobil;
        $bat->no_bat = $this->no_bat;
        $bat->tanggal_bat = $this->tanggal_bat;
        $bat->status = '';
        $bat->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_bat.' sudah di simpan.');
        return redirect()->to(route('bat'));
    }

    public function update()
    {
        $this->validate([
            'nama_cust'=>'required',
            'nopol'=>'required',
            'no_bat'=>'required',
            'tanggal_bat'=>'required'
        ]);
        $bat = Bat::find($this->id_bat);
        $bat->id_cust = $this->id_cust;
        $bat->id_mobil = $this->id_mobil;
        $bat->no_bat = $this->no_bat;
        $bat->tanggal_bat = $this->tanggal_bat;
        $bat->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_bat.' sudah di update.');
        return redirect()->to(route('bat'));
    }

    public function render()
    {
        return view('livewire.transaksi.bat-form');
    }
}
