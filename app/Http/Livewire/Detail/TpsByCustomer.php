<?php

namespace App\Http\Livewire\Detail;

use App\Models\Transaksi\TransaksiTPS;
use Livewire\Component;

class TpsByCustomer extends Component
{
    public $detailTps;

    protected $listeners = [
        'detailTps'
    ];

    public function detailTps($id_cust)
    {
        $this->detailTps = TransaksiTPS::whereRelation('sopir', 'id_cust', $id_cust)
            ->latest('id_transaksitps')->get();
        $this->emit('detailTpsModalShow');
    }

    public function resetDetail()
    {
        $this->reset(['detailTps']);
    }

    public function render()
    {
        return view('livewire.detail.tps-by-customer');
    }
}
