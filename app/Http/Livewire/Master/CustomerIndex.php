<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Customer;
use Livewire\Component;

class CustomerIndex extends Component
{
    public $id_cust;
    public $nama_customer;
    public $telp_customer;
    public $alamat_customer;
    public $status;

    protected function kode()
    {
        return null;
    }

    public function store()
    {
        $customer = new Customer;
        $customer->id_cust = $this->kode();
        $customer->nama_cust = $this->nama_customer;
        $customer->telp_cust = $this->telp_customer;
        $customer->alamat_cust = $this->alamat_customer;
        $customer->save();
    }

    public function update()
    {
        $customer = Customer::find($this->id_cust);
        $customer->nama_cust = $this->nama_customer;
        $customer->telp_cust = $this->telp_customer;
        $customer->alamat_cust = $this->alamat_customer;
        $customer->save();
    }

    public function updateBlokir($idCust, $status)
    {
        $customer = Customer::find($idCust);
        $customer->status = $status;
        $customer->save();
    }

    public function destroy($idCust)
    {
        $customer = Customer::destroy($idCust);
    }

    public function render()
    {
        return view('livewire.master.customer-index');
    }
}
