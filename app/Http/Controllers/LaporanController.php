<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Exports\LaporanExportView;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request){
        $filter = $request->all();

        $data['title'] = "Pesanan Anda";
        $data['mobil'] = Mobil::get();
        
        $data['pesanan'] = Pesanan::with(['keberangkatan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])
        ->when($filter['bulan'] ?? false, function ($q, $bulan) {
            $bulan = Carbon::parse($bulan)->toDate();
            return $q->whereHas('keberangkatan', function ($q) use ($bulan) {
                $q->whereMonth('tanggal', $bulan->format('m'))
                  ->whereYear('tanggal', $bulan->format('Y'));
            });
        })->when($filter['mobil'] ?? false, function ($q, $mobil) {
            return $q->whereHas('keberangkatan.mobils', function ($q) use ($mobil) {
                $q->where('mobil_id', $mobil);
            });
        })
        ->orderBy('id','desc')
        ->paginate(10);

        return view('report.index', $data);
    }

     public function export(Request $request)
    {
        $filter = $request->all();
        $filename = 'data';
        if (request('bulan') && request('mobil')) {
            $filename = '' . request('bulan') . ' mobil ' . request('mobil');
        } else if (request('bulan')) {
            $filename = 'Laporan bulan  ' . request('bulan');
        } else if (request('mobil')) {
            $filename = 'Laporan mobil ' . request('mobil');
        }
        return Excel::download(new LaporanExportView($filter), $filename.'.xlsx');
    }
}
