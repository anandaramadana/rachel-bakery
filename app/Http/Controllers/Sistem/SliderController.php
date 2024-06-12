<?php

namespace App\Http\Controllers\Sistem;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index() {
        return view('admin/slider', [
            'title' => 'Slider',
            'slider' => Slider::all(),
        ]);
    }

    public function tambah_slider(Request $request)
    {
        $data = $request->except(['token', 'submit']);
        $data['user_id'] = auth()->user()->id;

        $slider = Slider::create($data);
        if($request->has(('gambar'))){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $slider->gambar = $request->file('gambar')->getClientOriginalName();
            $slider->save();
        }
        if ($slider->save()) {
            return redirect('/slider')->with('tambah_slider', 'Gambar Berhasil Ditambah!');
        };
    }

    public function delete_slider($id)
    {
        Slider::find($id)->delete();
        return redirect()->back()->with("delete_slider","Gambar Berhasil di Hapus");
    }

    public function update_slider($id)
    {
        return view('admin/update/update_slider', [
            'title' => 'Update Slider',
            'slider'=> Slider::find($id)
        ]);
    }

    public function edit_slider(Request $request)
    {
        $slider = Slider::find($request->id);
        $slider->nama_slide = $request->nama_slide;


        $request->validate([
            'gambar' => 'nullable|image|mimes:pjeg,png,jpg,gif,svg',
         ]);
        // Periksa apakah ada file gambar yang diunggah
        if ($request->has('gambar')) {
            // Hapus gambar lama jika ada
            if ($slider->gambar) {
                Storage::delete('assets/img/' . $slider->gambar);
            }

            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $slider->gambar = $request->file('gambar')->getClientOriginalName();
        }

        if ($slider->save()) {
            return redirect('/slider')->with("edit_slider", "Berhasil Diupdate!");
        } else {
            // Handle the case where the save fails
            return redirect('/slider')->with("edit_slider", "Gagal Diupdate!");
        }
    }
}
