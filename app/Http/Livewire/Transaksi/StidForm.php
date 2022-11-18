<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Customer;
use App\Models\Transaksi\STID;
use Carbon\Carbon;
use Livewire\Component;

class StidForm extends Component
{
    public $id_stid;
    public $id_cust, $nama_cust;
    public $nopol;
    public $kode;
    public $masa_berlaku;
    public $status;

    public $update = false;

    protected $listeners = [
        'setCustomer'
    ];

    public function mount($id_stid = null)
    {
        $this->masa_berlaku = now('ASIA/JAKARTA');
        if ($id_stid){
            $this->update = true;
            $stid = STID::find($id_stid);
            $this->id_stid = $stid->id_stid;
            $this->id_cust = $stid->id_cust;
            $this->nama_cust = $stid->customer->nama_cust;
            $this->kode = $stid->kode;
            $this->nopol = $stid->nopol;
            $this->masa_berlaku = $stid->masa_berlaku;
        }
    }

    public function setCustomer(Customer $customer)
    {
        $this->id_cust = $customer->id_cust;
        $this->nama_cust = $customer->nama_cust;
        $this->emit('modalCustomerHide');
    }

    protected function kode()
    {
        $query = STID::latest('id_stid')->first();
        if ($query){
            $lastnum = (int) substr($query->id_stid, 3);
            $num = $lastnum + 1;
            return 'STD'.sprintf('%05s', $num);
        }
        return 'STD00001';
    }

    public function store()
    {
        $stid = new STID;
        $stid->id_stid = $this->kode();
        $stid->id_cust = $this->id_cust;
        $stid->nopol = $this->nopol;
        $stid->kode = $this->kode;
        $stid->masa_berlaku = $this->masa_berlaku;
        $stid->status = '';
        $stid->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_stid.' sudah disimpan.');
        return redirect()->to(route('stid.index'));
    }

    public function update()
    {
        $stid = STID::find($this->id_stid);
        $stid->id_cust = $this->id_cust;
        $stid->nopol = $this->nopol;
        $stid->kode = $this->kode;
        $stid->masa_berlaku = $this->masa_berlaku;
        $stid->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_stid.' sudah diupdate.');
        return redirect()->to(route('stid.index'));
    }

    public function render()
    {
        return view('livewire.transaksi.stid-form');
    }
}
