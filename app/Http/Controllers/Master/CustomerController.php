<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * @throws Exception
     */
    public function datatables(Request $request)
    {
        if ($request->ajax()){
            $data = Customer::latest('id_cust')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return null;
    }
}
