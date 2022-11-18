<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Customer;
use Livewire\Component;

class CustomerCRUD extends Component
{
    public $id_cust;
    public $nama_customer;
    public $telp_customer;
    public $alamat_customer;
    public $status;

    public $update = false;

    protected $listeners = [
        'store',
        'update',
        'edit',
        'updateBlokir',
        'confirmDestroy',
        'destroy',
        'resetId',
        'resetForm'
    ];

    public function resetId()
    {
        $this->reset(['id_cust']);
    }

    public function resetForm()
    {
        $this->reset([
            'id_cust', 'nama_customer', 'telp_customer', 'alamat_customer', 'status'
        ]);
        $this->update = false;
    }

    protected function kode(): string
    {
        $query = Customer::latest('id_cust')->first();
        if ($query){
            $lastnum = (int) substr($query->id_cust, 3);
            $num = $lastnum + 1;
            return 'CUS'.sprintf('%05s', $num);
        }
        return 'CUS00001';
    }

    public function store()
    {
        $this->validate([
            'nama_customer'=>'required',
            'telp_customer'=>'required',
            'alamat_customer'=>'required'
        ]);
        $customer = new Customer;
        $customer->id_cust = $this->kode();
        $customer->nama_cust = $this->nama_customer;
        $customer->telp_cust = $this->telp_customer;
        $customer->alamat_cust = $this->alamat_customer;
        $customer->status = '';
        $customer->save();
        $this->emit('modalCustomerHide');
    }

    public function edit($id_cust)
    {
        $this->update = true;
        $customer = Customer::find($id_cust);
        $this->id_cust = $customer->id_cust;
        $this->nama_customer = $customer->nama_cust;
        $this->telp_customer = $customer->telp_cust;
        $this->alamat_customer = $customer->alamat_cust;
        $this->emit('modalCustomerShow');
    }

    public function update()
    {
        $this->validate([
            'nama_customer'=>'required',
            'telp_customer'=>'required',
            'alamat_customer'=>'required'
        ]);
        $customer = Customer::find($this->id_cust);
        $customer->nama_cust = $this->nama_customer;
        $customer->telp_cust = $this->telp_customer;
        $customer->alamat_cust = $this->alamat_customer;
        $customer->save();
        $this->emit('modalCustomerHide');
    }

    public function updateBlokir($idCust, $status)
    {
        $customer = Customer::find($idCust);
        $customer->status = $status;
        $customer->save();
        $this->emit('refreshDatatables');
    }

    public function confirmDestroy($id_cust)
    {
        $this->id_cust = $id_cust;
    }

    public function destroy()
    {
        $customer = Customer::destroy($this->id_cust);
        $this->emit('modalNotificationHide');
    }

    public function render()
    {
        return view('livewire.master.customer-c-r-u-d');
    }
}
