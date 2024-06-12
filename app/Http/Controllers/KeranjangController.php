<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeranjangController extends Controller
{
    public function keranjang($id) {
        return view('keranjang', [
            'title' => 'Keranjang',
            'keranjang' => Menu::find($id),
        ]);
    }

    public function tambah_keranjang(Request $request)
    {
        // dd($request->all());
        $keranjang=new Keranjang;
        $keranjang->user_id=$request->user_id;
        $keranjang->menu_id=$request->menu_id;

        $keranjang->save();

        return redirect('/keranjang')->with("tambah_keranjang", "Pesanan berhasil Ditambah. Silakan lakukan pembayaran sebelum 24 jam!");
    }
}
