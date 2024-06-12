<?php

namespace App\Http\Controllers\Sistem;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function akun_admin()
    {
        return view('admin/akun-admin', [
            'title' => 'Akun Admin',
            'admin'=> User::all(),
        ]);
    }

    public function akun_customer()
    {
        return view('admin/akun-customer', [
            'title' => 'Akun Customer',
            'customer'=> User::all(),
        ]);
    }

    public function tambah_akun(Request $request)
    {
        $user=new User;
        $user->nama=$request->nama;
        $user->alamat=$request->alamat;
        $user->no_hp=$request->no_hp;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->role=$request->role;
        $user->save();

        return redirect('/akun-admin')->with("tambah_akun","Daftar Berhasil!");
    }

    public function delete_akun($id)
    {
        user::find($id)->delete();
        return redirect()->back()->with("delete_akun","Akun Berhasil di Hapus");
    }

    public function update_akun($id)
    {
        return view('admin/update/update_admin', [
            'title' => 'Update user',
            'user'=> User::find($id)
        ]);
    }

    public function edit_akun(Request $request)
    {
        $user= User::find($request->id);
        $user->nama=$request->nama;
        $user->email=$request->email;
        $user->no_hp=$request->no_hp;
        $user->alamat=$request->alamat;
        $user->save();

        return redirect('akun-admin')->with("update_admin","Berhasil Diupdate!");
    }
}
