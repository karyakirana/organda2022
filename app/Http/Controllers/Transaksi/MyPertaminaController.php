<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\MyPertamina;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MyPertaminaController extends Controller
{
    public function index()
    {
        return view('pages.transaksi-mypertamina-index');
    }

    public function indexBlokir()
    {
        return view('pages.transaksi-mypertamina-index-blokir');
    }

    public function blokir(Request $request)
    {
        $myPertamina = MyPertamina::find($request->id);
        $myPertamina->status = 'Blokir';
        $myPertamina->save();
    }

    public function unBlokir(Request $request)
    {
        $myPertamina = MyPertamina::find($request->id);
        $myPertamina->status = '';
        $myPertamina->save();
    }

    public function destroy(Request $request)
    {
        return MyPertamina::destroy($request->id);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = MyPertamina::with('customer')
                ->whereNot('status', 'Blokir')
                ->latest('id_mypertamina')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
        $data = MyPertamina::with('customer')
            ->where('status', 'Blokir')
            ->latest('id_mypertamina')->get();
        return DataTables::of($data)
            ->make(true);
    }
        return null;
    }
}
