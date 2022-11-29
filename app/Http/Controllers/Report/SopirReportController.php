<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Master\Sopir;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SopirReportController extends Controller
{
    public function index()
    {
        return view('pages.report-sopir-index');
    }

    public function sopir()
    {
        return Sopir::with(['transaksiLamong', 'transaksiTps', 'customer'])
            ->whereHas('customer', function (Builder $query){
                $query->whereNot('status', 'Blokir');
            });
    }

    public function sopirDatatables(Request $request)
    {
        if ($request->ajax()){
            $data = $this->sopir()->get();
            return \DataTables::of($data)->toJson();
        }
        return null;
    }
}
