<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function tambah_user(Request $request)
    {
        $user=new User;
        $user->nama=$request->nama;
        $user->alamat=$request->alamat;
        $user->no_hp=$request->no_hp;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->role=$request->role;
        $user->save();

        return redirect('/')->with("tambah_user","Daftar Berhasil, Silahkan Login untuk Melakukan Pemesanan!");
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Jika berhasil login, dapatkan role pengguna
            $role = Auth::user()->role;

            // Arahkan pengguna berdasarkan peran (role)
            if ($role == 'admin') {
                return redirect('/admin');
            } elseif ($role == 'customer') {
                return redirect('/');
            } else {
                // Tambahkan logika lain jika ada peran lainnya
                return redirect('/');
            }
        } else {
            return back()->with('loginError', 'Login Gagal, Silahkan Masukkan Email dan Password yang Benar! ');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // CUSTOMER
    public function update_user()
    {
        return view('profile', [
            'title' => 'Update user',
            'user'=> User::all()
        ]);
    }

    public function edit_gambar($id, Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:pjeg,png,jpg,gif,svg',
         ]);

        $User = User::find($id);
        $User->update($request->only(['gambar']));
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $User->gambar = $request->file('gambar')->getClientOriginalName();
            $User->save();
        }
        if ($User->save()){
            return redirect('/profile/{id}/edit')->with('edit_gambar', 'Gambar Profil Berhasil Diupdate');
        }
    }

    public function edit_user(Request $request)
    {
        $user= User::find($request->id);
        $user->nama=$request->nama;
        $user->email=$request->email;
        $user->no_hp=$request->no_hp;
        $user->alamat=$request->alamat;
        $user->save();

        return redirect('/profile/{id}/edit')->with("edit_user","Profil Berhasil Diupdate!");
    }

    // ADMIN
    public function update_admin()
    {
        return view('admin/profile-admin', [
            'title' => 'Update user',
            'user'=> User::all()
        ]);
    }

    public function edit_gambar_admin($id, Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:pjeg,png,jpg,gif,svg',
         ]);

        $User = User::find($id);
        $User->update($request->only(['gambar']));
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $User->gambar = $request->file('gambar')->getClientOriginalName();
            $User->save();
        }
        if ($User->save()){
            return redirect('/profile-admin/{id}/edit')->with('edit_gambar_admin', 'Gambar Profil Berhasil Diupdate');
        }
    }

    public function edit_admin(Request $request)
    {
        $user= User::find($request->id);
        $user->nama=$request->nama;
        $user->email=$request->email;
        $user->no_hp=$request->no_hp;
        $user->alamat=$request->alamat;
        $user->save();

        return redirect('/profile-admin/{id}/edit')->with("edit_admin","Profil Berhasil Diupdate!");
    }
}
