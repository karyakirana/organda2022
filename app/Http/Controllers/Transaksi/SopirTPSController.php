<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\TransaksiTPS;
use DataTables;
use Illuminate\Http\Request;

class SopirTPSController extends Controller
{
    public function index()
    {
        return view('pages.transaksi-tps-index');
    }

    public function indexBlokir()
    {
        return view('pages.transaksi-tps-index-blokir');
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = TransaksiTPS::with(['sopir', 'sopir.customer'])
                ->latest('id_transaksitps')
                ->whereNot('status', 'Blokir')->get();
            return DataTables::of($data)->toJson();
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = TransaksiTPS::with(['sopir', 'sopir.customer'])
                ->latest('id_transaksitps')
                ->where('status', 'Blokir')->get();
            return DataTables::of($data)->toJson();
        }
        return null;
    }

    public function blokir(Request $request)
    {
        $query = TransaksiTPS::find($request->id);
        return $query->update([
            'status' => 'Blokir'
        ]);
    }

    public function unblokir(Request $request)
    {
        $query = TransaksiTPS::find($request->id);
        return $query->update([
            'status' => ''
        ]);
    }

    public function destroy(Request $request)
    {
        return TransaksiTPS::destroy($request->id);
    }
}
