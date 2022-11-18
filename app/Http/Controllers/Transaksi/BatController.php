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

    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Bat::with(['customer', 'mobil'])
                ->latest('id_bat')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function destroy(Request $request)
    {
        return Bat::destroy($request->id);
    }
}
