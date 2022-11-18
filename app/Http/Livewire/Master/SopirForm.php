<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Customer;
use App\Models\Master\Sopir;
use Livewire\Component;

class SopirForm extends Component
{
    public $id_sopir;
    public $id_card;
    public $id_cust, $nama_cust;
    public $nama_sopir;
    public $telp_sopir;
    public $ktp_sopir;
    public $sim_sopir;
    public $alamat_sopir;
    public $status;

    public $update = false;

    protected $listeners = [
        'setCustomer'
    ];

    public function mount($id_sopir = null)
    {
        if ($id_sopir){
            $this->update = true;
            $sopir = Sopir::find($id_sopir);
            $this->id_sopir = $sopir->id_sopir;
            $this->id_cust = $sopir->id_cust;
            $this->nama_cust = $sopir->customer->nama_cust;
            $this->nama_sopir = $sopir->nama_sopir;
            $this->telp_sopir = $sopir->telp_sopir;
            $this->ktp_sopir = $sopir->ktp_sopir;
            $this->sim_sopir = $sopir->sim_sopir;
            $this->alamat_sopir = $sopir->alamat_sopir;
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
        $query = Sopir::latest('id_sopir')->first();
        if ($query){
            $lastnum = (int) substr($query->id_sopir, 3);
            $num = $lastnum + 1;
            return 'SOP'.sprintf('%05s', $num);
        }
        return 'SOP00001';
    }

    public function store()
    {
        $this->validate([
            'nama_cust'=>'required',
            'nama_sopir'=>'required',
            'ktp_sopir'=>'required',
            'sim_sopir'=>'required',
            'alamat_sopir'=>'required',
        ]);
        $sopir = new Sopir;
        $sopir->id_sopir = $this->kode();
        $sopir->id_card = $this->id_card ?? '';
        $sopir->id_cust = $this->id_cust;
        $sopir->nama_sopir = $this->nama_sopir;
        $sopir->telp_sopir = $this->telp_sopir ?? '';
        $sopir->ktp_sopir = $this->ktp_sopir;
        $sopir->sim_sopir = $this->sim_sopir;
        $sopir->alamat_sopir = $this->alamat_sopir;
        $sopir->status = '';
        $sopir->save();
        session()->flash('message', 'Data '.$this->id_sopir.' sudah di simpan.');
        return redirect()->to(route('sopir'));
    }

    public function update()
    {
        $this->validate([
            'nama_cust'=>'required',
            'nama_sopir'=>'required',
            'ktp_sopir'=>'required',
            'sim_sopir'=>'required',
            'alamat_sopir'=>'required',
        ]);
        $sopir = Sopir::find($this->id_sopir);
        $sopir->id_card = $this->id_card ?? '';
        $sopir->id_cust = $this->id_cust;
        $sopir->nama_sopir = $this->nama_sopir;
        $sopir->telp_sopir = $this->telp_sopir ?? '';
        $sopir->ktp_sopir = $this->ktp_sopir;
        $sopir->sim_sopir = $this->sim_sopir;
        $sopir->alamat_sopir = $this->alamat_sopir;
        $sopir->save();
        session()->flash('message', 'Data '.$this->id_sopir.' sudah di update.');
        return redirect()->to(route('sopir'));
    }

    public function render()
    {
        return view('livewire.master.sopir-form');
    }
}
