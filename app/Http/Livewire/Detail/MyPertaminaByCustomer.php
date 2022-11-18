<?php

namespace App\Http\Livewire\Detail;

use App\Models\Transaksi\MyPertamina;
use Livewire\Component;

class MyPertaminaByCustomer extends Component
{
    public $detailMyPertamina;

    protected $listeners = [
        'detailMyPertamina',
        'resetDetail',
    ];

    public function detailMyPertamina($id_cust)
    {
        $this->detailMyPertamina = MyPertamina::where('id_cust', $id_cust)
            ->latest('id_mypertamina')->get();
        $this->emit('detailMyPertaminaModalShow');
    }

    public function resetDetail()
    {
        $this->reset(['detailMyPertamina']);
    }
    public function render()
    {
        return view('livewire.detail.my-pertamina-by-customer');
    }
}
