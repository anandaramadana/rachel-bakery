<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index() {
        return view('index', [
            'title' => 'index',
            'kategori' => Kategori::all(),
            'slider' => Slider::all()
        ]);
    }

    public function kategori() {
        return view('admin/kategori', [
            'title' => 'kategori',
            'kategori' => Kategori::all(),
        ]);
    }

    public function tambah_kategori(Request $request)
    {
        $data = $request->except(['token', 'submit']);
        // $data['user_id'] = auth()->user()->id;

        $paket = Kategori::create($data);
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $paket->gambar = $request->file('gambar')->getClientOriginalName();
            $paket->save();
        }
        if ($paket->save()) {
            return redirect('/kategori')->with('tambah_kategori', 'Kategori Berhasil Ditambah!');
        };
    }

    public function delete_kategori($id)
    {
        Kategori::find($id)->delete();
        return redirect()->back()->with("delete_kategori","Kategori Berhasil di Hapus");
    }

    public function update_kategori($id)
    {
        return view('admin/update/update_kategori', [
            'title' => 'Update Kategori',
            'kategori'=> Kategori::find($id)
        ]);
    }

    public function edit_kategori(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->deskripsi = $request->deskripsi;


        $request->validate([
            'gambar' => 'nullable|image|mimes:pjeg,png,jpg,gif,svg',
         ]);
        // Periksa apakah ada file gambar yang diunggah
        if ($request->has('gambar')) {
            // Hapus gambar lama jika ada
            if ($kategori->gambar) {
                Storage::delete('assets/img/' . $kategori->gambar);
            }

            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $kategori->gambar = $request->file('gambar')->getClientOriginalName();
        }

        if ($kategori->save()) {
            return redirect('/kategori')->with("edit_kategori", "Berhasil Diupdate!");
        } else {
            // Handle the case where the save fails
            return redirect('/kategori')->with("edit_kategori", "Gagal Diupdate!");
        }
    }
}
