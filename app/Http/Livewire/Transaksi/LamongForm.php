<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Customer;
use App\Models\Master\Sopir;
use App\Models\Transaksi\Lamong;
use Livewire\Component;

class LamongForm extends Component
{
    public $id_translamong;
    public $id_cust, $nama_cust;
    public $id_sopir, $nama_sopir;
    public $nik_lamong;
    public $status = '';

    public $update = false;

    protected $listeners = [
        'setCustomer',
        'setSopir'
    ];

    public function mount($id_lamong = null)
    {
        if ($id_lamong){
            $this->update = true;
            $lamong = Lamong::find($id_lamong);
            $this->id_translamong = $lamong->id_translamong;
            $this->id_sopir = $lamong->id_sopir;
            $this->nama_sopir = $lamong->sopir->nama_sopir;
            $this->nik_lamong = $lamong->nik_lamong;
        }
    }

    public function setCustomer(Customer $customer)
    {
        $this->id_cust = $customer->id_cust;
        $this->nama_cust = $customer->nama_cust;
        $this->emit('modalCustomerHide');
    }

    public function setSopir(Sopir $sopir)
    {
        $this->id_sopir = $sopir->id_sopir;
        $this->nama_sopir = $sopir->nama_sopir;
        $this->emit('modalSopirHide');
    }

    protected function kode()
    {
        $query = Lamong::latest('id_translamong')->first();
        if ($query){
            $lastnum = (int) substr($query->id_translamong, 3);
            $num = $lastnum + 1;
            return 'LAM'.sprintf('%05s', $num);
        }
        return 'LAM00001';
    }

    public function store()
    {
        $telukLamong = new Lamong;
        $telukLamong->id_translamong = $this->kode();
        $telukLamong->id_sopir = $this->id_sopir;
        $telukLamong->nik_lamong = $this->nik_lamong;
        $telukLamong->status = $this->status;
        $telukLamong->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_translamong.' sudah di simpan.');
        return redirect()->to(route('lamong'));
    }

    public function update()
    {
        $telukLamong = Lamong::find($this->id_translamong);
        $telukLamong->id_sopir = $this->id_sopir;
        $telukLamong->nik_lamong = $this->nik_lamong;
        $telukLamong->save();
        // redirect
        session()->flash('message', 'Data '.$this->id_translamong.' sudah di update.');
        return redirect()->to(route('lamong'));
    }

    public function render()
    {
        return view('livewire.transaksi.lamong-form');
    }
}
