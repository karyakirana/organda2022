<?php

namespace App\Http\Livewire\Detail;

use App\Models\Transaksi\STID;
use Livewire\Component;

class StidByCustomer extends Component
{
    public $detailStid;

    protected $listeners = [
        'detailStid',
        'resetDetail'
    ];

    public function detailStid($id_cust)
    {
        $this->detailStid = STID::where('id_cust', $id_cust)
            ->latest('id_stid')->get();
        $this->emit('detailStidModalShow');
    }

    public function resetDetail()
    {
        $this->reset(['detailStid']);
    }

    public function render()
    {
        return view('livewire.detail.stid-by-customer');
    }
}
