<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\STID;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class STIDController extends Controller
{
    public function index()
    {
        return view('pages.transaksi-stid-index');
    }

    public function indexBlokir()
    {
        return view('pages.transaksi-stid-index-blokir');
    }

    public function blokir(Request $request)
    {
        $query = STID::find($request->id);
        $query->status = 'Blokir';
        $query->save();
    }

    public function unBlokir(Request $request)
    {
        $query = STID::find($request->id);
        $query->status = '';
        $query->save();
    }

    public function destroy(Request $request)
    {
        return STID::destroy($request->id);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = STID::with(['customer'])
                ->whereNot('status', 'Blokir')
                ->latest('id_stid')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = STID::with('customer')
                ->where('status', 'Blokir')
                ->latest('id_stid')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }
}
