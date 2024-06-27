<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMobilRequest;
use App\Http\Requests\UpdateMobilRequest;

class MobilController extends Controller
{
    
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
    
    public function create(Request $request)
    {
        $data = $request->validate([
            'plat' => 'required',
            'nama' => 'required',
            'kapasitas' => 'required',
            'warna' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('mobil');
        }
        
        Mobil::create($data);
        
        return redirect('/mobil')->with('success','Data Mobil Berhasil Ditambahkan');
    }

    
    public function show(Mobil $mobil)
    {
        $data = [
            'title' => 'Update Data Mobil',
            'mobil' => $mobil
        ];

        return view('mobil.updateMobile',$data);
    }

   
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'plat' => 'required',
            'nama' => 'required',
            'kapasitas' => 'required',
            'warna' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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

    
    public function destroy(Mobil $mobil)
    {
        Storage::delete($mobil->foto);

        $mobil->delete();
        return back()->with('success', 'Data Mobil Berhasil Dihapus');
    }
}
