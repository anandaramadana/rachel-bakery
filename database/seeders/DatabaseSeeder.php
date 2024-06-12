<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            "nama"  => "admin",
            "alamat"  => "Bangkalan",
            "no_hp" => "084134353122",
            "email" => "admin@gmail.com",
            "password" => Hash::make("12345"),
            "gambar" => "admin.jpg",
            "role" => "admin",
          ],[
            "nama"  => "customer",
            "alamat"  => "Bangkalan",
            "no_hp" => "083847086323",
            "email" => "customer@gmail.com",
            "password" => Hash::make("12345"),
            "gambar" => "admin.jpg",
            "role" => "customer",
        ]]);

        DB::table('kategoris')->insert([[
            "nama_kategori"  => "Roti",
            "deskripsi"  => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "gambar" => "kategori-roti.jpg",
          ],[
            "nama_kategori"  => "Tradisional",
            "deskripsi"  => "Kue yang telah hadir sejak sebelum tahun 2000 menjadi inspirasi kami menghadirkan varian kue ini",
            "gambar" => "kategori-tradisional.jpg",
          ],[
            "nama_kategori"  => "Chiffon",
            "deskripsi"  => "Kue yang populer di wilayah Asia Tenggara dikenal dengan sebutan bolu dengan tekstur yang lebih tebal dan padat",
            "gambar" => "kategori-chiffon.jpg",
          ],[
            "nama_kategori"  => "Pastry",
            "deskripsi"  => "Kue yang memiliki tekstur kering berasal dari adonan diguling halus berlapis - lapis dengan mentega dan lemak",
            "gambar" => "kategori-pastry.jpg",
          ],[
            "nama_kategori"  => "Cakes",
            "deskripsi"  => "Kue yang memiliki tekstur seperti bolu dengan tekstur pada dan tebal, namun terdapat penambahan topping dan hiasan",
            "gambar" => "kategori-cakes.jpg",
          ],[
            "nama_kategori"  => "Cookies",
            "deskripsi"  => "Kue yang tergolong kue kering sebagai cemilan dengan rasanya yang manis dan bentuknya yang kecil - kecil",
            "gambar" => "kategori-cookies.jpg",
        ]
        ]);

        DB::table('menus')->insert([[
            "kategori_id" => "1",
            "nama_kue" => "Roti O",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "roti-o.jpg",
          ],[
            "kategori_id" => "2",
            "nama_kue" => "Lemper Ayam",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "lemper-ayam.jpg",
          ],[
            "kategori_id" => "3",
            "nama_kue" => "Muffin Cokelat",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "muffin-coklat.jpg",
          ],[
            "kategori_id" => "4",
            "nama_kue" => "Pisang Bolen",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "pisang-bolen.jpg",
          ],[
            "kategori_id" => "5",
            "nama_kue" => "Cheese Cake",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "cheese-cake.jpg",
          ],[
            "kategori_id" => "6",
            "nama_kue" => "Kaastengels",
            "deskripsi" => "Kue yang menggunakan roti sebagai bahan dasar dengan pemberian toping - toping tertentu",
            "harga" => "10000",
            "gambar" => "kaastengels.jpg",
        ]
        ]);

        DB::table('sliders')->insert([[
            "nama_slide" => "gambar 1",
            "gambar" => "slide2.png",
        ],[
            "nama_slide" => "gambar 2",
            "gambar" => "slide3.png",
        ],
        ]);

        DB::table('pembayarans')->insert([[
            "nama_metode" => "Bank BRI",
            "no_rek" => "626262626262",
            "atas_nama" => "Admin",
            "gambar" => "bri.png",
        ],[
            "nama_metode" => "Bank Jatim",
            "no_rek" => "313131313131",
            "atas_nama" => "Admin",
            "gambar" => "jatim.png",
        ],[
            "nama_metode" => "Bayar Langsung",
            "no_rek" => "Offline",
            "atas_nama" => "Admin",
            "gambar" => "admin.jpg",
        ]
        ]);
    }
}
