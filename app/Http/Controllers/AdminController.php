<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\User;
use App\Models\Order;

use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index()
    {
        // return view('admin.dashboard');
        $barangs = Barang::all();
        $users = User::all();
        // $orders = Order::with(['barang', 'user'])->get(); // Relasi barang dan user
        $orders = Order::with(['barang', 'user'])
        ->where('statusPemesanan', 'Menunggu Proses Pemesanan')
        ->get(); // Ambil hanya yang memiliki status "Menunggu Proses"

        // dd($barangs); // Cek apakah data ada di sini
        // Kirim data ke view 'user.dashboard'
        return view('admin.dashboard', compact('barangs', 'users','orders'));
    }

    public function updateStatus($id)
    {
        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Periksa status saat ini
        if ($order->statusPemesanan === 'Menunggu Proses Pemesanan') {
            $order->statusPemesanan = 'Sedang Diproses'; // Ubah status
            $order->save(); // Simpan perubahan
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}