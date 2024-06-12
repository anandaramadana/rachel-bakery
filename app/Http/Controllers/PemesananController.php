<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PemesananController extends Controller
{
    // HALAMAN CUSTOMER
    public function riwayat()
    {
        $pesan = Pemesanan::with(['user', 'menu'])
        ->where(function ($query) {
            $query->where('waktu_expired', '<', now())
                ->whereIn('status', ['Lunas', 'Menunggu Konfirmasi', 'Bayar DP']);
        })
        ->orWhere('waktu_expired', '>', now())
        ->get();

        return view('riwayat', [
            'title' => 'Pemesanan',
            'pesan' => $pesan,
        ]);
    }

    public function hal_pesan($id)
    {
        return view('pemesanan', [
            'title' => 'Pemesanan',
            'menu'=> Menu::find($id),
            'user'=> User::find($id),
            'pembayaran'=> Pembayaran::all(),
        ]);
    }

    public function tambah_pemesanan(Request $request)
    {
        // dd($request->all());
        $pemesanan=new Pemesanan;
        $pemesanan->user_id=$request->user_id;
        $pemesanan->menu_id=$request->menu_id;
        $pemesanan->pembayaran_id=$request->pembayaran_id;
        $pemesanan->tanggal_ambil=$request->tanggal_ambil;
        $pemesanan->jam_ambil=$request->jam_ambil;
        $pemesanan->qty=$request->qty;
        $pemesanan->total_harga= intval($request->total_harga);
        $pemesanan->keterangan=$request->keterangan;

        // Hitung waktu expired (24 jam dari sekarang)
        $waktuExpired = now()->addDay();
        // Simpan waktu_expired ke dalam pemesanan
        $pemesanan->waktu_expired = $waktuExpired;

        $pemesanan->save();

        return redirect('/riwayat')->with("tambah_pemesanan", "Pesanan berhasil Ditambah. Silakan lakukan pembayaran sebelum 24 jam!");
    }

    public function delete_pemesanan($id)
    {
        pemesanan::find($id)->delete();
        return redirect()->back()->with("delete_pemesanan","Pesanan Berhasil Dihapus");
    }

    public function bukti($id, Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
         ]);

        $Pemesanan = Pemesanan::find($id);
        // dd();
        $Pemesanan->update($request->only(['bukti_pembayaran']));
        if($request->has(('bukti_pembayaran'))){
            $request->file('bukti_pembayaran')->move('assets/img/', $request->file('bukti_pembayaran')->getClientOriginalName());
            $Pemesanan->bukti_pembayaran = $request->file('bukti_pembayaran')->getClientOriginalName();
            $Pemesanan->status = 'Menunggu Konfirmasi';
            $Pemesanan->save();
        }
        if ($Pemesanan->save()){
            return redirect()->back()->with('tambah_bukti', 'Bukti pembayaran berhasil diupload');
        }
    }

    public function invoice($id)
    {
        $invoice = Pemesanan::with(['user', 'menu', 'menu.kategori', 'pembayaran'])
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        return view('invoice', [
            'title' => 'Invoice',
            'invoice' => $invoice,
        ]);
    }

    public function cetak_butki($id)
    {
        $invoice = Pemesanan::with(['user', 'menu', 'menu.kategori', 'pembayaran'])
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        return view('cetak', [
            'title' => 'Invoice',
            'invoice' => $invoice,
        ]);
        return view('cetak', compact('riwayat'));
    }


    // HALAMAN ADMIN
    public function order()
    {
        $order = Pemesanan::select('*')->whereIn('status',[ 'Belum terverifikasi', 'Menunggu Konfirmasi', 'Bayar DP'])->get();

        return view('admin/order', compact('order'));
    }

    public function laporan()
    {
        $riwayat = Pemesanan::select('*')->where('status', 'Lunas')->get();
        $total = DB::table('pemesanans')->where('status', ['Lunas'])->sum('total_harga');
        return view('admin/laporan',compact('riwayat','total'));
    }

    public function pesanankonfirmasi($id)
    {
        DB::table('pemesanans')->where('id',$id)->update(['status' => 'Lunas']);
        return redirect('/order')->with("update_pesan","Pesanan Berhasil Terkonfirmasi!");

    }

    public function pesanandp($id)
    {
        DB::table('pemesanans')->where('id',$id)->update(['status' => 'Bayar DP']);
        return redirect('/order')->with("update_pesan","Pesanan Berhasil Terkonfirmasi!");
    }

    public function cetak_laporan()
    {
        $riwayat = Pemesanan::select('*')->where('status', 'Lunas')->get();
        $total = DB::table('pemesanans')->where('status', ['Lunas'])->sum('total_harga');
        return view('admin/export-laporan',compact('riwayat','total'));
    }

    public function pesananbatal($id)
    {
        DB::table('pemesanans')->where('id',$id)->delete();
        return redirect('/order')->with('delete_pesan', "Pesanan Berhasil Dihapus!");
    }

}
