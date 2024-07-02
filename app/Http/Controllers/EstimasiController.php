<?php

namespace App\Http\Controllers;

use App\Models\Estimasi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstimasiRequest;
use App\Http\Requests\UpdateEstimasiRequest;
use App\Models\Keberangkatan;

class EstimasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Estimasi";
        $data['kota'] = Estimasi::paginate(10);
        return view('kota.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kota.addKota');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);

        Estimasi::create([
            'name' => $request->input('kota'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
        ]);

        return redirect('/estimasi')->with('success', 'Data Kota Estimasi berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimasi $estimasi)
    {
        $data = [
            "title" => "Update Keberangkatan",
            "estimasi" => $estimasi
        ];

        // dd($data);
        return view('kota.editKota',$data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kota' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);

        $data = [
            'name' => $request->input('kota'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
        ];

        $kota = Estimasi::findOrFail($id);

        $kota->update($data);

        return redirect('/estimasi')->with('success', 'Data Kota Estimasi berhasil diubah');
    }

    public function destroy(Estimasi $estimasi)
    {
        $estimasi->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
