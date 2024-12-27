{{-- <h1>Welcome Admin</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form> --}}



{{-- <h1>Welcome Admin</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<h2>Tambah Data Barang</h2>
<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required>
    </div>

    <div>
        <label for="jenis_barang">Jenis Barang:</label>
        <select id="jenis_barang" name="jenis_barang" required>
            <option value="">Pilih Jenis Barang</option>
            <option value="elektronik">Elektronik</option>
            <option value="furniture">Furniture</option>
            <option value="pakaian">Pakaian</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div>
        <label for="harga_barang">Harga Barang:</label>
        <input type="number" id="harga_barang" name="harga_barang" required>
    </div>

    <div>
        <label for="gambar_barang">Gambar Barang:</label>
        <input type="file" id="gambar_barang" name="gambar_barang" accept="image/*" required>
    </div>

    <button type="submit">Kirim Data</button>
</form> --}}

<link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">

<h1 class="welcome-title">Welcome Admin</h1>
<form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="logout-button">Logout</button>
</form>

<h2>Daftar Pengguna Terdaftar</h2>

<div class="cardbox-container">
    <div class="cardbox">
        <div class="cardbox-number">
            {{ $users->filter(function ($user) {return $user->role === 'admin';})->count() }} Pengguna Admin Terdaftar
        </div>
    </div>
</div>

<!-- Tabel Pengguna yang dapat discroll jika lebih dari 10 -->
<div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Registrasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $key => $user)
                @if ($user->role === 'admin')
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5">Belum ada pengguna admin yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<h2>Daftar Barang</h2>
{{-- @dd($users); --}}
<div class="cardbox-container">
    <div class="cardbox">
        <div class="cardbox-number">{{ count($barangs) }} Stock Barang</div>
    </div>
</div>


<!-- Tabel Pengguna yang dapat discroll jika lebih dari 10 -->
<div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Harga Barang</th>
                <th>Tanggal Barang Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $key => $barang)
                {{-- @if ($user->role === 'admin') --}}
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->jenis_barang }}</td>
                    <td>{{ $barang->harga_barang }}</td>
                    <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                {{-- @endif --}}
            @empty
                <tr>
                    <td colspan="5">Belum ada pengguna barang yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<h2>Daftar Pesanan</h2>
<div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Pemesan</th>
                <th>Status Pemesanan</th>
                <th>Tanggal Pemesanan</th>
                <th>Aksi</th> <!-- Kolom tambahan untuk aksi -->
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->barang->nama_barang }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->statusPemesanan }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if ($order->statusPemesanan === 'Menunggu Proses Pemesanan')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Memproses</button>
                            </form>
                        @else
                            <span>-</span> <!-- Jika status bukan "Menunggu Proses" -->
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


</br>
</br>
</br>

<h2 class="section-title">Tambah Data Barang</h2>
<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
    @csrf
    <div class="form-group">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required>
    </div>

    <div class="form-group">
        <label for="jenis_barang">Jenis Barang:</label>
        <select id="jenis_barang" name="jenis_barang" required>
            <option value="">Pilih Jenis Barang</option>
            <option value="elektronik">Elektronik</option>
            <option value="furniture">Furniture</option>
            <option value="pakaian">Pakaian</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="form-group">
        <label for="harga_barang">Harga Barang:</label>
        <input type="number" id="harga_barang" name="harga_barang" required>
    </div>

    <div class="form-group">
        <label for="gambar_barang">Gambar Barang:</label>
        <input type="file" id="gambar_barang" name="gambar_barang" accept="image/*" required>
    </div>

    <button type="submit" class="submit-button">Kirim Data</button>
</form>
