<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Customer;
use App\Models\Transaksi\MyPertamina;
use Livewire\Component;

class MyPertaminaForm extends Component
{
    public $id_mypertamina;
    public $id_cust, $nama_cust;
    public $nopol;
    public $status;

    public $update = false;

    protected $listeners = [
        'setCustomer'
    ];

    public function mount($id_mypertamina = null)
    {
        if ($id_mypertamina){
            $this->update = true;
            $myPertamina = MyPertamina::find($id_mypertamina);
            $this->id_mypertamina = $myPertamina->id_mypertamina;
            $this->id_cust = $myPertamina->id_cust;
            $this->nama_cust = $myPertamina->customer->nama_cust;
            $this->nopol = $myPertamina->nopol;
            $this->status = $myPertamina->status;
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
        $query = MyPertamina::latest('id_mypertamina')->first();
        if ($query){
            $lastnum = (int) substr($query->id_mypertamina, 3);
            $num = $lastnum + 1;
            return 'MPT'.sprintf('%05s', $num);
        }
        return 'MPT00001';
    }

    public function store()
    {
        $myPertamina = new MyPertamina;
        $myPertamina->id_mypertamina = $this->kode();
        $myPertamina->id_cust = $this->id_cust;
        $myPertamina->nopol = $this->nopol;
        $myPertamina->status = '';
        $myPertamina->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_mypertamina.' sudah disimpan.');
        return redirect()->to(route('mypertamina.index'));
    }

    public function update()
    {
        $myPertamina = MyPertamina::find($this->id_mypertamina);
        $myPertamina->id_cust = $this->id_cust;
        $myPertamina->nopol = $this->nopol;
        $myPertamina->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_mypertamina.' sudah diupdate.');
        return redirect()->to(route('mypertamina.index'));
    }

    public function render()
    {
        return view('livewire.transaksi.my-pertamina-form');
    }
}
