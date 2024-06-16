<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeranjangController extends Controller
{
    public function keranjang() {
        return view('keranjang', [
            'title' => 'Keranjang',
            'keranjang' => Keranjang::all(),
        ]);
    }

    public function tambah_keranjang(Request $request)
    {
        $data = $request->except(['token', 'submit']);
        $keranjang = Keranjang::create($data);

        $keranjang->save();

        return redirect('/keranjang')->with("tambah_keranjang", "Keranjang berhasil Ditambah!");
    }

    public function delete_keranjang($id)
    {
        Keranjang::find($id)->delete();
        return redirect()->back()->with("delete_keranjang","Keranjang Berhasil di Hapus");
    }
}
