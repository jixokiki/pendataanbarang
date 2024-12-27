<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Order;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string',
            'harga_barang' => 'required|numeric',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload file gambar
        $path = $request->file('gambar_barang')->store('public/images');

        // Simpan data ke database
        Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'jenis_barang' => $validated['jenis_barang'],
            'harga_barang' => $validated['harga_barang'],
            'gambar_barang' => $path,
        ]);

        // Redirect atau respons
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function index()
    {
        // Ambil semua data dari tabel 'barangs'
        $barangs = Barang::all();
        $users = User::all();
        // $orders = Order::with(['barang', 'user'])->get(); // Relasi barang dan user
        $orders = Order::with(['barang', 'user'])
        ->where('statusPemesanan', 'Menunggu Proses Pemesanan')
        ->get(); // Ambil hanya yang memiliki status "Menunggu Proses"
        // dd($barangs); // Cek apakah data ada di sini
        // Kirim data ke view 'user.dashboard'
        return view('user.dashboard', compact('barangs', 'users','orders'));
        // return view('user.barang', compact('barangs'));
    }
}