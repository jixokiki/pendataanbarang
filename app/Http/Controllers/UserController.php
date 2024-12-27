<?php


// namespace App\Http\Controllers;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index()
//     {
//         return view('user.dashboard');
//     }
// }


namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Pastikan ini ada

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user'); // Middleware diterapkan pada controller ini
    }

    // public function store(Request $request)
    // {
    //     // Validasi data
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //         'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Simpan data ke database
    //     Barang::create([
    //         'nama_barang' => $validated['nama_barang'],
    //         'jenis_barang' => $validated['jenis_barang'],
    //         'harga_barang' => $validated['harga_barang'],
    //     ]);

    //     // Redirect atau respons
    //     return redirect()->back()->with('success', 'Data berhasil disimpan.');
    // }
    
    public function index()
    {
                // Ambil semua data dari tabel 'barangs'
        $barangs = Barang::all();
        $users = User::all();
        dd($barangs); // Cek apakah data ada di sini
        // Kirim data ke view 'user.dashboard'
        // return view('user.dashboard', compact('barangs'));
        return view('user.dashboard', compact('users'));
    }
}