<?php

namespace App\Http\Livewire\Detail;

use App\Models\Transaksi\Lamong;
use Livewire\Component;

class TelukLamongByCustomer extends Component
{
    public $detailTelukLamong;

    protected $listeners = [
        'detailTelukLamong',
        'resetDetail',
    ];

    public function detailTelukLamong($id_cust)
    {
        $this->detailTelukLamong = Lamong::where('id_cust', $id_cust)
            ->latest('id_translamong')->get();
        $this->emit('detailLamongModalShow');
    }

    public function resetDetail()
    {
        $this->reset(['detailTelukLamong']);
    }

    public function render()
    {
        return view('livewire.detail.teluk-lamong-by-customer');
    }
}
