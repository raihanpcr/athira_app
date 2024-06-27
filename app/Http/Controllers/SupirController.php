<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => "Data Supir",
            'supir' => Supir::paginate(10)
        ];

        return view('supir.index',$data);
    }

    public function create()
    {
        return view('supir.addSupir',[
            'title' => 'Tambah Data Supir'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('supir');
        }

        Supir::create($data);
        
        return redirect('/supir')->with('success','Data Supir Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = [
            'title' => 'Update Data Supir',
            'supir' => Supir::findOrFail($id)
        ];

        return view('supir.updateSupir',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supir $supir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $mobil = Supir::findOrFail($id);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['foto'] = $request->file('foto')->store('supir');
        }

        $mobil->update($data);

        return redirect('/supir')->with('success','Data Supir Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supir $supir)
    {
        Storage::delete($supir->foto);

        $supir->delete();
        return back()->with('success','Data Supir Berhasil Dihapus');
    }
}
