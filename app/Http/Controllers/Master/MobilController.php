<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Mobil;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MobilController extends Controller
{
    public function index()
    {
        return view('pages.mobil-index');
    }

    public function indexBlokir()
    {
        return view('pages.mobil-index-blokir');
    }

    public function blokir(Request $request)
    {
        $mobil = Mobil::find($request->id);
        $mobil->status = 'Blokir';
        $mobil->save();
    }

    public function unblokir(Request $request)
    {
        $mobil = Mobil::find($request->id);
        $mobil->status = '';
        $mobil->save();
    }

    /**
     * @throws Exception
     */
    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Mobil::with('customer')
                ->whereNot('status', 'Blokir')
                ->latest('id_mobil')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = Mobil::with('customer')
                ->where('status', 'Blokir')->latest('id_mobil')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function destroy(Request $request)
    {
        return Mobil::destroy($request->id);
    }
}
