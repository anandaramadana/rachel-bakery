<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Keranjang;
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
        $selectedItems = $request->input('selected_items');
        $user_id = $request->input('user_id');
        $quantities = $request->input('quantities');
        $pembayaran_id = $request->input('pembayaran_id');
        $tanggal_ambil = $request->input('tanggal_ambil');
        $jam_ambil = $request->input('jam_ambil');
        $keterangan = $request->input('keterangan');

        foreach ($selectedItems as $itemId) {
            $keranjang = Keranjang::find($itemId);

            if ($keranjang) {
                $pemesanan = new Pemesanan;
                $pemesanan->user_id = $user_id;
                $pemesanan->menu_id = $keranjang->menu_id;
                $pemesanan->pembayaran_id = $pembayaran_id;
                $pemesanan->tanggal_ambil = $tanggal_ambil;
                $pemesanan->jam_ambil = $jam_ambil;
                $pemesanan->qty = $quantities[$itemId];
                $pemesanan->total_harga = $keranjang->menu->harga * $quantities[$itemId];
                $pemesanan->keterangan = $keterangan;

                // Hitung waktu expired (24 jam dari sekarang)
                $pemesanan->waktu_expired = now()->addDay();

                $pemesanan->save();

                // Hapus item dari keranjang
                $keranjang->delete();
            }
        }

        return redirect('/riwayat')->with("tambah_pemesanan", "Pesanan berhasil ditambah. Silakan lakukan pembayaran sebelum 24 jam!");
    }

    public function beli_sekarang(Request $request)
    {
        $pemesanan = new Pemesanan;
        $pemesanan->user_id = $request->user_id;
        $pemesanan->menu_id = $request->menu_id;
        $pemesanan->pembayaran_id = $request->pembayaran_id;
        $pemesanan->tanggal_ambil = $request->tanggal_ambil;
        $pemesanan->jam_ambil = $request->jam_ambil;
        $pemesanan->qty = $request->qty;
        $pemesanan->total_harga= intval($request->total_harga);
        $pemesanan->keterangan = $request->keterangan;

        // Hitung waktu expired (24 jam dari sekarang)
        $waktuExpired = now()->addDay();
        // $waktuExpired = now()->addMinutes(1);
        // Simpan waktu_expired ke dalam pemesanan
        $pemesanan->waktu_expired = $waktuExpired;

        $pemesanan->save();

        return redirect('/riwayat')->with("tambah_pemesanan", "Pesanan berhasil ditambah.");
    }

    public function checkout(Request $request)
    {
        $selectedItems = $request->input('selected_items');
        $quantities = $request->input('quantities');

        if (!$selectedItems) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu item untuk checkout.');
        }

        $keranjangs = Keranjang::whereIn('id', $selectedItems)->with('menu')->get();
        $pembayaran = Pembayaran::all(); // Ambil data pembayaran

        return view('checkout', compact('keranjangs', 'pembayaran', 'quantities'));
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
