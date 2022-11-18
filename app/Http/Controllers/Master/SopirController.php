<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Sopir;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SopirController extends Controller
{
    public function index()
    {
        return view('pages.sopir-index');
    }

    public function indexBlokir()
    {
        return view('pages.sopir-index-blokir');
    }

    public function blokir(Request $request)
    {
        $sopir = Sopir::find($request->id);
        $sopir->status = 'Blokir';
        $sopir->save();
    }

    public function unBlokir(Request $request)
    {
        $sopir = Sopir::find($request->id);
        $sopir->status = '';
        $sopir->save();
    }

    public function destroy(Request $request)
    {
        return $sopir = Sopir::destroy($request->id);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Sopir::with('customer')
                ->whereNot('status', 'Blokir')->latest('id_sopir')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = Sopir::with('customer')
                ->where('status', 'Blokir')->latest('id_sopir')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }
}
