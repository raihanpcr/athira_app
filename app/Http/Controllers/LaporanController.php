<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $data['title'] = "Pesanan Anda";
        $data['pesanan'] = Pesanan::with(['keberangkatan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])
        ->orderBy('id','desc')
        ->paginate(10);

        return view('report.index',$data);
    }
}
