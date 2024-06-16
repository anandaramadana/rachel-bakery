<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function hal_depan() {
        return view('informasi-pembayaran', [
            'title' => 'Pembayaran',
            'pembayaran' => Pembayaran::all(),
        ]);
    }

    public function index() {
        return view('admin/pembayaran', [
            'title' => 'Pembayaran',
            'pembayaran' => Pembayaran::all(),
        ]);
    }

    public function tambah_pembayaran(Request $request)
    {
        $data = $request->except(['token', 'submit']);
        // $data['user_id'] = auth()->user()->id;

        $pembayaran = Pembayaran::create($data);
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $pembayaran->gambar = $request->file('gambar')->getClientOriginalName();
            $pembayaran->save();
        }
        if ($pembayaran->save()) {
            return redirect('/pembayaran')->with('tambah_pembayaran', 'Metode Pembayaran Berhasil Ditambah!');
        };
    }

    public function delete_pembayaran($id)
    {
        Pembayaran::find($id)->delete();
        return redirect()->back()->with("delete_pembayaran","Metode Pembayaran Berhasil di Hapus");
    }

    public function update_pembayaran($id)
    {
        return view('admin/update/update_pembayaran', [
            'title' => 'Update Pembayaran',
            'pembayaran'=> Pembayaran::find($id)
        ]);
    }

    public function edit_pembayaran(Request $request)
    {
        $pembayaran = Pembayaran::find($request->id);
        $pembayaran->nama_metode = $request->nama_metode;
        $pembayaran->no_rek = $request->no_rek;
        $pembayaran->atas_nama = $request->atas_nama;


        $request->validate([
            'gambar' => 'nullable|image|mimes:pjeg,png,jpg,gif,svg',
         ]);
        // Periksa apakah ada file gambar yang diunggah
        if ($request->has('gambar')) {
            // Hapus gambar lama jika ada
            if ($pembayaran->gambar) {
                Storage::delete('assets/img/' . $pembayaran->gambar);
            }

            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $pembayaran->gambar = $request->file('gambar')->getClientOriginalName();
        }

        if ($pembayaran->save()) {
            return redirect('/pembayaran')->with("edit_pembayaran", "Berhasil Diupdate!");
        } else {
            // Handle the case where the save fails
            return redirect('/pembayaran')->with("edit_pembayaran", "Gagal Diupdate!");
        }
    }
}
