<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index() {
        $kategoris = Kategori::all();
        $menus = Menu::all();
        return view('menu', [
            'title' => 'menu',
            'kategoris' => $kategoris,
            'menus' => $menus
        ]);
    }

    public function detail_menu($id) {
        return view('menu-detail', [
            'title' => 'menu-detail',
            'detail'=> Menu::find($id)
        ]);
    }

    public function list_menu() {
        return view('admin/menu', [
            'title' => 'Menu',
            'menu' => Menu::all(),
            'kategori' => Kategori::all(),
        ]);
    }

    public function tambah_menu(Request $request)
    {
        $data = $request->except(['token', 'submit']);
        $paket = Menu::create($data);
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $paket->gambar = $request->file('gambar')->getClientOriginalName();
            $paket->save();
        }
        if ($paket->save()) {
            return redirect('/list-menu')->with('tambah_menu', 'Menu Berhasil Ditambah!');
        };
    }

    public function delete_menu($id)
    {
        Menu::find($id)->delete();
        return redirect()->back()->with("delete_menu","Menu Berhasil di Hapus");
    }

    public function update_menu($id)
    {
        return view('admin/update/update_menu', [
            'title' => 'Update Kategori',
            'menu'=> Menu::find($id),
            'kategori' => Kategori::all()
        ]);
    }

    public function edit_menu(Request $request)
    {
        $menu = Menu::find($request->id);
        $menu->kategori_id = $request->kategori_id;
        $menu->nama_kue = $request->nama_kue;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;


        $request->validate([
            'gambar' => 'nullable|image|mimes:pjeg,png,jpg,gif,svg',
         ]);
        // Periksa apakah ada file gambar yang diunggah
        if ($request->has('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar) {
                Storage::delete('assets/img/' . $menu->gambar);
            }

            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $menu->gambar = $request->file('gambar')->getClientOriginalName();
        }

        if ($menu->save()) {
            return redirect('/list-menu')->with("edit_menu", "Berhasil Diupdate!");
        } else {
            // Handle the case where the save fails
            return redirect('/list-menu')->with("edit_menu", "Gagal Diupdate!");
        }
    }
}
