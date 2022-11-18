<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.customer-index');
    }

    /**
     * @throws Exception
     */
    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Customer::whereNot('status', 'Blokir')->latest('id_cust')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }

    public function blokir()
    {
        return view('pages.customer-index-blokir');
    }

    /**
     * @throws Exception
     */
    public function datatablesBlokir(Request $request)
    {
        if ($request->ajax()){
            $data = Customer::where('status', 'Blokir')->latest('id_cust')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }
}
