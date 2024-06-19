<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'alamat' => 'required',
            'nohp' => 'required|max:30',
            'jk' => 'required',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        
        return redirect('/login')->with('success', 'Task was successful!');
    }

    public function showProfile(User $user){

        $data = [
            "title" => "Detail Data",
            "profile" => $user
        ];

        // dd($data);s

        return view('profile', $data);
    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);

        $profile = User::findOrFail($id);

        $profile->update($validatedData);

        return redirect('/keberangkatan')->with('success', 'Data profile berhasil diedit');
    }
}
