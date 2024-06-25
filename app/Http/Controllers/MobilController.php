<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMobilRequest;
use App\Http\Requests\UpdateMobilRequest;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Mobil',
            'mobil' => Mobil::paginate(10)
        ];

        return view('mobil.index',$data);
    }

    public function add(){
        return view('mobil.addMobil',[
            'title' => 'Tambah Data Mobil'
        ]);
    }
    /**
     
    * Show the form for creating a new resource.
     
     */
    public function create(Request $request)
    {
        
        $data = $request->validate([
            'plat' => 'required',
            'nama' => 'required',
            'kapasitas' => 'required',
            'warna' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('mobil');
        }
        
        Mobil::create($data);
        
        return redirect('/mobil')->with('success','Data Mobil Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobilRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        $data = [
            'title' => 'Update Data Mobil',
            'mobil' => $mobil
        ];

        // dd($data);
        return view('mobil.updateMobile',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->validate([
            'plat' => 'required',
            'nama' => 'required',
            'kapasitas' => 'required',
            'warna' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $mobil = Mobil::findOrFail($id);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('mobil');
        }

        $mobil->update($data);

        return redirect('/mobil')->with('success','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        Storage::delete($mobil->foto);

        $mobil->delete();
        return back()->with('success', 'Data Mobil Berhasil Dihapus');
    }
}
