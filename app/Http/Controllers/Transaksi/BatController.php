<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\Bat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BatController extends Controller
{
    public function index()
    {
        return view('pages.bat-index');
    }

    public function indexBlokir()
    {
        return view('pages.bat-index-blokir');
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Bat::with(['customer', 'mobil'])
                ->whereNot('status', 'Blokir')
                ->latest('id_bat')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = Bat::with(['customer', 'mobil'])
                ->where('status', 'Blokir')
                ->latest('id_bat')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function blokir(Request $request)
    {
        $query = Bat::find($request->id);
        $query->status = 'Blokir';
        $query->save();
    }

    public function unBlokir(Request $request)
    {
        $query = Bat::find($request->id);
        $query->status = '';
        $query->save();
    }

    public function destroy(Request $request)
    {
        return Bat::destroy($request->id);
    }
}
