<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Requests\StorePesananRequest;
use App\Http\Requests\UpdatePesananRequest;
use App\Models\Keberangkatan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        
        $data['title'] = "Pesanan Anda";
        $data['pesanan'] = Pesanan::with(['keberangkatan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])
        ->orderBy('id','desc')
        ->where('user_id', $user)
        ->paginate(10);
        // dd($data);

        return view('pemesanan.pemesanan',$data);
    }

    public function cancled(Request $request, $id)
    {
        $request->validate([
            'alasan' =>'required'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'cancled'=>$request->input('alasan')
        ]);
        $keberangkatan = Keberangkatan::findOrFail($request->input('bangku'));
        $new_jumlah = $keberangkatan->kuota + $request->input('jml_bangku');    
        // dd($keberangkatan);
        

        $keberangkatan->update([
            'kuota' => $new_jumlah
        ]);

        return redirect('/pesanan')->with('success', 'Pesanan Berhasil Dibatalkan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bangku' => 'required',
            'jemput' => 'required',
            'turun' => 'required'
        ]);

        $data = [
            'jml_bangku' => $request->input('bangku'),
            'maps' => $request->input('maps'),
            'jemput' => $request->input('jemput'),
            'turun' => $request->input('turun'),
            'biaya' => 150000 * $request->input('bangku'),
            'keterangan' => "Dipesan",
            'keberangkatan_id' => $request->input('keberangkatan'),
            'user_id'=>$request->input('user')
        ];

        Pesanan::create($data);

        $keberangkatan = Keberangkatan::findOrFail($request->input('keberangkatan'));

        $new_jumlah = $keberangkatan->kuota - $request->input('bangku');

        $keberangkatan->update([
            'kuota' => $new_jumlah
        ]);

        return redirect('/pesanan')->with('success', 'Data berhasil ditambah');
    }

    public function show(Pesanan $pesanan)
    {
        $data = [
            "title" => "Pembatalan Pesanan",
            "pesanan" => $pesanan
        ];

        return view('pemesanan.cancle',$data);
    }

    public function showDetail(Pesanan $pesanan){
        $data = [
            "title" => "Detail Pesanan",
            "pesanan" => $pesanan::with(['pemesan','keberangkatan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])->first()
        ];

        // dd($data);

        return view('pemesanan.detail',$data);
    }

    public function bayar()
    {
        $data['title'] = "Pembayaran";
        $data['pesanan'] = Pesanan::with(['keberangkatan','pemesan','keberangkatan.mobils','keberangkatan.tujuans','keberangkatan.asals'])
        ->orderBy('id','desc')
        ->paginate(10);

        // dd($data);

        return view('pemesanan.pembayaran',$data);
    }

    public function viewPdf(Pesanan $pesanan){
        
        // dd($pesanan::with(['pemesan', 'keberangkatan', 'keberangkatan.mobils', 'keberangkatan.tujuans', 'keberangkatan.asals'])->first());
        $pesanans = $pesanan::with(['pemesan', 'keberangkatan', 'keberangkatan.mobils', 'keberangkatan.tujuans', 'keberangkatan.asals'])->first();
        $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
        $mpdf->AddPage('L');
        $mpdf->SetWatermarkText('PT. ATHIRA TRAVEL');

        // Set the watermark to be displayed
        $mpdf->showWatermarkText = true;

        // Optionally, you can adjust the watermark properties
        $mpdf->watermarkTextAlpha = 0.1; // Transparency of the watermark
        $mpdf->watermark_font = 'DejaVuSansCondensed'; // Font for the watermark
        $mpdf->WriteHTML(view('pemesanan.tiket', [
            "title" => "Detail Pesanan",
            "pesanans" => $pesanans
        ])->render());
        // $filename = 'Detail_Pesanan.pdf';

        // Output the PDF to the browser with the specified filename
        $mpdf->Output('', '');
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function konfirmasiPembayaran(Pesanan $pesanan)
    {
        $pesanan->update([
            'keterangan' => "Sudah Dibayar"
        ]);

        return redirect('/pembayaran')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
