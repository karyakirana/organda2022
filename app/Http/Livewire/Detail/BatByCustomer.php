<?php

namespace App\Http\Livewire\Detail;

use App\Models\Transaksi\Bat;
use Livewire\Component;

class BatByCustomer extends Component
{
    public $detailBat;

    protected $listeners = [
        'detailBat',
        'resetDetail',
    ];

    public function detailBat($id_cust)
    {
        $this->detailBat = Bat::where('id_cust', $id_cust)
            ->latest('id_bat')->get();
        $this->emit('detailBatModalShow');
    }

    public function resetDetail()
    {
        $this->reset(['detailBat']);
    }

    public function render()
    {
        return view('livewire.detail.bat-by-customer');
    }
}
