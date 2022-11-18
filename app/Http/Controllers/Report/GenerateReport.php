<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use Barryvdh\Snappy\Facades\SnappyPdf;
use DB;
use Illuminate\Http\Request;
use Knp\Snappy\Pdf;

class GenerateReport extends Controller
{
    public function index()
    {
        $mypertamina = DB::table('transaksi_mypertamina')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, null as teluk_lamong, null as stid, count(customer.id_cust) as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_mypertamina.id_cust')
            ->whereNot('transaksi_mypertamina.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $stid = DB::table('stid')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, null as teluk_lamong, count(customer.id_cust) as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'stid.id_cust')
            ->whereNot('stid.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $telukLamong = DB::table('transaksi_lamong')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, count(customer.id_cust) as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_lamong.id_cust')
            ->whereNot('transaksi_lamong.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $transaksiBat = DB::table('transaksi_bat')
            ->selectRaw('nama_cust, customer.id_cust as id, count(customer.id_cust) as bat, null as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_bat.id_cust')
            ->groupBy('customer.id_cust')
            ->unionAll($mypertamina)
            ->unionAll($stid)
            ->unionAll($telukLamong);
        $union = DB::query()->fromSub($transaksiBat, 't')
            ->selectRaw('customer.nama_cust, id, sum(bat) as yoman, sum(teluk_lamong) as lamong, sum(stid) as sum_stid, sum(mypertamina) as sum_mypertamina')
            ->join('customer', 'customer.id_cust', 't.id')
            ->groupBy('t.id')
            ->get();
        return view('pages.generate-report', ['customer'=>$union]);
    }

    public function toPdf()
    {
        $pdf = SnappyPdf::loadView('pdf.generate-report');
        return $pdf->inline('receipt-penerimaan-penjualan.pdf');
    }
}
