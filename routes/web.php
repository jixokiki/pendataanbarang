<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\BarangController;

use Illuminate\Http\Request;
use App\Models\Order;


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
// });


// Route::middleware(['auth', 'role:admin'])->get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// Route::middleware(['auth', 'role:user'])->get('/user', [UserController::class, 'index'])->name('user.dashboard');Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'role:user']);

// Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'role:user']);

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
// });


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});


// Route::get('/user', function () {
//     if (Auth::user()->role !== 'user') {
//         return redirect('/');
//     }
//     return view('user.dashboard');
// })->middleware(['auth']);


// Route untuk dashboard user
Route::middleware(['auth'])->group(function () {
    Route::get('/user', function () {
        if (Auth::user()->role !== 'user') {
            return redirect('/');
        }
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Route untuk dashboard admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
});



Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

Route::get('/user', [BarangController::class, 'index'])->name('user.dashboard');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::patch('/orders/{id}/update-status', [AdminController::class, 'updateStatus'])->name('orders.updateStatus');

// buat order 


Route::post('/order', function (Request $request) {
    // Menggunakan facade Auth untuk mendapatkan pengguna yang sedang login
    $user = Auth::user();

    // Mengecek apakah pengguna sudah login
    if ($user) {
        $order = new Order();
        $order->barang_id = $request->barang_id;
        $order->user_id = $user->id; // Mengakses ID dari objek pengguna yang sedang login
        $order->statusPemesanan='Menunggu Proses Pemesanan';
        $order->save();

        return response()->json(['message' => 'Pesanan berhasil ditambahkan!']);
    }

    return response()->json(['message' => 'User belum login.'], 401);
})->middleware('auth');


// Route::post('/order', function (Request $request) {
//     // Menggunakan facade Auth untuk mendapatkan pengguna yang sedang login
//     $user = Auth::user();

//     // Mengecek apakah pengguna sudah login
//     if ($user) {
//         $order = new Order();
//         $order->barang_id = $request->barang_id;
//         $order->user_id = $user->id; // Mengakses ID dari objek pengguna yang sedang login
//         $order->statusPemesanan = 'menunggu proses'; // Menambahkan status pemesanan
//         $order->save();

//         return response()->json(['message' => 'Pesanan berhasil ditambahkan!']);
//     }

//     return response()->json(['message' => 'User belum login.'], 401);
// })->middleware('auth');




// Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
// Route::get('/user/barang', [BarangController::class, 'index'])->name('barang.index');



// Gate::define('isAdmin', function ($user) {
//     return $user->role === 'admin';
// });

// Gate::define('isUser', function ($user) {
//     return $user->role === 'user';
// });

// Route::middleware(['auth', 'can:isUser'])->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
// });

// Route::middleware(['auth', 'can:isAdmin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// });