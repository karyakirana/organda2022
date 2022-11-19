<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use DB;
use Illuminate\Http\Request;
use PDF;

class GenerateReport extends Controller
{
    public function index()
    {
        $mypertamina = DB::table('transaksi_mypertamina')
            ->selectRaw('customer.id_cust as id, null as bat, null as teluk_lamong, null as stid, count(customer.id_cust) as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_mypertamina.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_mypertamina.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $stid = DB::table('stid')
            ->selectRaw('customer.id_cust as id, null as bat, null as teluk_lamong, count(customer.id_cust) as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'stid.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('stid.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $telukLamong = DB::table('transaksi_lamong')
            ->selectRaw('customer.id_cust as id, null as bat, count(customer.id_cust) as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_lamong.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_lamong.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $transaksiBat = DB::table('transaksi_bat')
            ->selectRaw('customer.id_cust as id, count(customer.id_cust) as bat, null as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_bat.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_bat.status', 'Blokir')
            ->groupBy('customer.id_cust')
            ->unionAll($mypertamina)
            ->unionAll($stid)
            ->unionAll($telukLamong);
        $union = DB::query()->fromSub($transaksiBat, 't')
            ->selectRaw('nama_cust, id, sum(bat) as yoman, sum(teluk_lamong) as lamong, sum(stid) as sum_stid, sum(mypertamina) as sum_mypertamina')
            ->join('customer', 'customer.id_cust', 't.id')
            ->groupBy('t.id')
            ->get();
        $pdf = PDF::loadView('pdf.generate-report', ['data'=>$union]);
        $pdf->setPaper('a4');
        return view('pages.generate-report', ['customer'=>$union]);
    }

    public function toPdf()
    {
        $mypertamina = DB::table('transaksi_mypertamina')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, null as teluk_lamong, null as stid, count(customer.id_cust) as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_mypertamina.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_mypertamina.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $stid = DB::table('stid')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, null as teluk_lamong, count(customer.id_cust) as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'stid.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('stid.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $telukLamong = DB::table('transaksi_lamong')
            ->selectRaw('nama_cust, customer.id_cust as id, null as bat, count(customer.id_cust) as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_lamong.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_lamong.status', 'Blokir')
            ->groupBy('customer.id_cust');
        $transaksiBat = DB::table('transaksi_bat')
            ->selectRaw('nama_cust, customer.id_cust as id, count(customer.id_cust) as bat, null as teluk_lamong, null as stid, null as mypertamina')
            ->join('customer', 'customer.id_cust', 'transaksi_bat.id_cust')
            ->whereNot('customer.status', 'Blokir')
            ->whereNot('transaksi_bat.status', 'Blokir')
            ->groupBy('customer.id_cust')
            ->unionAll($mypertamina)
            ->unionAll($stid)
            ->unionAll($telukLamong);
        $union = DB::query()->fromSub($transaksiBat, 't')
            ->selectRaw('nama_cust, id, sum(bat) as yoman, sum(teluk_lamong) as lamong, sum(stid) as sum_stid, sum(mypertamina) as sum_mypertamina')
            ->join('customer', 'customer.id_cust', 't.id')
            ->groupBy('t.id')
            ->get();
        $pdf = PDF::loadView('pdf.generate-report', ['data'=>$union]);
        $pdf->setPaper('a4');
        return $pdf->inline('receipt-penerimaan-penjualan.pdf');
    }
}
