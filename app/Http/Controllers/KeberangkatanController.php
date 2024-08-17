<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Supir;
use App\Models\Estimasi;
use Illuminate\Http\Request;
use App\Models\Keberangkatan;

class KeberangkatanController extends Controller
{
    public function index()
    {
        // $data['keberangkatan'] = Keberangkatan::paginate(10);
        $data['keberangkatan'] = Keberangkatan::with(['mobils','supirs','asals','tujuans'])->paginate(10);
        $data['mobil'] = Mobil::paginate(5);
        $data['supir'] = Supir::paginate(5);

        return view('keberangkatan.dashboard', $data);
    }

    public function form(){
        $data['estimasi'] = Estimasi::get();
        $data['mobil'] = Mobil::get();
        $data['supir'] = Supir::get();

        return view('keberangkatan.keberangkatan',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tanggal' => 'required',
            'kuota' => 'required',
            'pukul' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ]);

        $existingSchedule = Keberangkatan::where('supir_id', $request->input('supir'))
                            ->where('tanggal', $request->input('tanggal'))
                            ->first();

        if ($existingSchedule) {
            return redirect()->back()->withErrors(['supir' => 'Supir sudah terjadwal pada tanggal dan waktu tersebut.'])->withInput();
        }

        $data = [
            'tanggal' => $request->input('tanggal'),
            'kuota' => $request->input('kuota'),
            'pukul' => $request->input('pukul'),
            'asal' => $request->input('asal'),
            'tujuan' => $request->input('tujuan'),
            'mobil_id' => $request->input('mobil'),
            'supir_id' => $request->input('supir')
        ];

        Keberangkatan::create($data);
        return redirect('/keberangkatan')->with('success', 'Data berhasil ditambah');
        // dd($validatedData);
    }

    //TODO: Update Keberangkatan
    public function showDetail( Keberangkatan $keberangkatan){

        $data= [
            "title"=>"Update Keberangkatan",
            "estimasi" => Estimasi::get(),
            "mobil" => Mobil::get(),
            "supir" => Supir::get(),
            "keberangkatan"=>$keberangkatan
        ];
        // dd($data);
        return view('keberangkatan.updateKeberangkatan',$data);
    }

    public function orderKeberangkatan( Keberangkatan $keberangkatan){

        
        $data = [
            "title" => "Info Keberangkatan",
            "keberangkatan" => $keberangkatan::with(['mobils','supirs','asals','tujuans'])->findOrFail($keberangkatan->id)
        ];

        // dd($data);
        
        return view('orders.addKeberangkatan',$data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'kuota' => 'required',
            'pukul' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ]);

        $data = [
            'tanggal' => $request->input('tanggal'),
            'kuota' => $request->input('kuota'),
            'pukul' => $request->input('pukul'),
            'asal' => $request->input('asal'),
            'tujuan' => $request->input('tujuan'),
            'mobil_id' => $request->input('mobil'),
            'supir_id' => $request->input('supir')
        ];

        // dd($validatedData);

        $keberangkatan = Keberangkatan::findOrFail($id);

        // dd($keberangkatan);

        $keberangkatan->update($data);

        return redirect('/keberangkatan')->with('success', 'Data berhasil diedit');
    }

    public function destroy(Keberangkatan $keberangkatan)
    {
        $keberangkatan->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
