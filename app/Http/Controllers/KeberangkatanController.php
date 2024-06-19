<?php

namespace App\Http\Controllers;

use App\Models\Keberangkatan;
use Illuminate\Http\Request;

class KeberangkatanController extends Controller
{
    public function index()
    {
        $data['keberangkatan'] = Keberangkatan::paginate(10);
        // dd($data);
        return view('keberangkatan.dashboard', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'kuota' => 'required',
            'pukul' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ]);

        Keberangkatan::create($validatedData);
        return redirect('/keberangkatan')->with('success', 'Data berhasil ditambah');
        // dd($validatedData);
    }

    //TODO: Update Keberangkatan
    public function showDetail( Keberangkatan $keberangkatan){

        $data= [
            "title"=>"Update Keberangkatan",
            "keberangkatan"=>$keberangkatan
        ];
        // dd($data);
        return view('keberangkatan.updateKeberangkatan',$data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'kuota' => 'required',
            'pukul' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
        ]);

        // dd($validatedData);
        $keberangkatan = Keberangkatan::findOrFail($id);

        // dd($keberangkatan);

        $keberangkatan->update($validatedData);

        return redirect('/keberangkatan')->with('success', 'Data berhasil diedit');
    }

    public function destroy(Keberangkatan $keberangkatan)
    {
        $keberangkatan->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
