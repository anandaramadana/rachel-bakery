<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function navbar() {
        return view('admin/index', [
            'title' => 'Update user',
            'user'=> User::all()
        ]);
    }

    public function dashboard() {
        $pemasukan = DB::table('pemesanans')->whereIn('status', ['Bayar DP', 'Lunas'])->sum('total_harga');
        $menu = DB::table('menus')->count();
        $customer = DB::table('users')->where('role', 'customer')->count();
        $pesanan = DB::table('pemesanans')->whereIn('status', ['Bayar DP', 'Lunas'])->count();

        // Query untuk mendapatkan pendapatan bulanan
        $monthlyEarnings = DB::table('pemesanans')
        ->select(DB::raw('SUM(total_harga) as total'), DB::raw('MONTH(created_at) as month'))
        ->whereIn('status',['Bayar DP','Lunas'])
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total', 'month')
        ->toArray();

        // Inisialisasi array dengan 0 untuk setiap bulan
        $monthlyEarningsData = array_fill(1, 12, 0);
        foreach ($monthlyEarnings as $month => $total) {
            $monthlyEarningsData[$month] = $total;
        }

        $categories = DB::table('kategoris')
        ->join('menus', 'kategoris.id', '=', 'menus.kategori_id')
        ->select('kategoris.nama_kategori', DB::raw('COUNT(menus.id) as total_menu'))
        ->groupBy('kategoris.nama_kategori')
        ->get();

        // Memisahkan data menjadi dua array: satu untuk label dan satu untuk data
        $labels = $categories->pluck('nama_kategori')->toArray();
        $total_menu = $categories->pluck('total_menu')->toArray();

        return view('admin/index', compact('pemasukan','menu','customer','pesanan','monthlyEarningsData','labels','total_menu'));
    }
}
