<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\Lamong;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LamongController extends Controller
{
    public function index()
    {
        return view('pages.transaksi-lamong-index');
    }

    public function indexBlokir()
    {
        return view('pages.transaksi-lamong-index-blokir');
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Lamong::with(['sopir.customer', 'sopir'])
                ->whereNot('status', 'Blokir')
                ->latest('id_translamong')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = Lamong::with(['sopir', 'sopir.customer'])
                ->where('status', 'Blokir')
                ->latest('id_translamong')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function blokir(Request $request)
    {
        $lamong = Lamong::find($request->id);
        $lamong->status = 'Blokir';
        $lamong->save();
    }

    public function unBlokir(Request $request)
    {
        $lamong = Lamong::find($request->id);
        $lamong->status = '';
        $lamong->save();
    }

    public function destroy(Request $request)
    {
        return Lamong::destroy($request->id);
    }
}
