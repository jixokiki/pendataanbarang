{{-- <h1>Welcome User</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<h2>Daftar Barang</h2>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Harga Barang</th>
            <th>Gambar Barang</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $key => $barang)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ ucfirst($barang->jenis_barang) }}</td>
                <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ Storage::url($barang->gambar_barang) }}" alt="{{ $barang->nama_barang }}" width="100">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada data barang.</td>
            </tr>
        @endforelse
    </tbody>
</table>
 --}}



<h1 class="welcome-title">Welcome User</h1>
<form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="logout-button">Logout</button>
</form>

<h1>Pengguna</h1>
<!-- Cardbox untuk menampilkan total jumlah pengguna -->
<div class="cardbox-container">
    <div class="cardbox">
        <div class="cardbox-number">{{ count($users) }} </div>
    </div>
</div>

<h2>Daftar Barang</h2>
{{-- @dd($users); --}}
<div class="cardbox-container">
    <div class="cardbox">
        <div class="cardbox-number">{{ count($barangs) }} Stock Barang</div>
    </div>
</div>

{{-- <table border="1">
    <thead>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Harga Barang</th>
            <th>Gambar Barang</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $key => $barang)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ ucfirst($barang->jenis_barang) }}</td>
                <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ Storage::url($barang->gambar_barang) }}" alt="{{ $barang->nama_barang }}"
                        width="100">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada data barang.</td>
            </tr>
        @endforelse
    </tbody>
</table> --}}


<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container">
    @forelse($barangs as $key => $barang)
        <div class="card">
            <div class="card-header">
                <h3>{{ $key + 1 }}. {{ $barang->nama_barang }}</h3>
            </div>
            <div class="card-body">
                <div class="product-image">
                    <img src="{{ Storage::url($barang->gambar_barang) }}" alt="{{ $barang->nama_barang }}"
                        width="150">
                </div>
                <div class="product-info">
                    <p><strong>Jenis:</strong> {{ ucfirst($barang->jenis_barang) }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                </div>
                <div class="product-actions">
                    <button class="like-btn" onclick="handleLike({{ $barang->id }})">👍 Like</button>
                    <button class="dislike-btn" onclick="handleDislike({{ $barang->id }})">👎 Dislike</button>
                    <textarea placeholder="Tambahkan komentar..." class="comment-box" data-id="{{ $barang->id }}"></textarea>
                    <button class="order-btn" onclick="handleOrder({{ $barang->id }})">🛒 Order</button>
                </div>
            </div>
        </div>
    @empty
        <p>Belum ada data barang.</p>
    @endforelse
</div>

<script>
    function handleLike(id) {
        // Implementasi aksi like (AJAX request atau logika lain)
        alert(`Barang ID ${id} di-Like`);
    }

    function handleDislike(id) {
        // Implementasi aksi dislike
        alert(`Barang ID ${id} di-Dislike`);
    }

    // function handleOrder(id) {
    //     // Implementasi aksi order (AJAX request untuk menambahkan data ke table orders)
    //     fetch('/order', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             },
    //             body: JSON.stringify({
    //                 barang_id: id
    //             })
    //         })
    //         .then(response => response.json())
    //         .then(data => alert(data.message))
    //         .catch(error => console.error('Error:', error));
    // }
    function handleOrder(id) {
        fetch('/order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF untuk memastikan permintaan aman
                },
                body: JSON.stringify({
                    barang_id: id // Kirim ID barang yang ingin dipesan
                })
            })
            .then(response => response.json())
            .then(data => alert(data.message)) // Menampilkan pesan sukses atau error
            .catch(error => console.error('Error:', error));
    }
</script>

<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-around;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        padding: 15px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .card-header h3 {
        margin: 0;
    }

    .product-image img {
        border-radius: 10px;
    }

    .product-info {
        margin: 10px 0;
    }

    .product-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .like-btn,
    .dislike-btn,
    .order-btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .like-btn {
        background-color: #4CAF50;
        color: white;
    }

    .dislike-btn {
        background-color: #f44336;
        color: white;
    }

    .order-btn {
        background-color: #2196F3;
        color: white;
    }

    .comment-box {
        width: 100%;
        min-height: 50px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
</style>


<h2>Daftar Pengguna Terdaftar</h2>

<div class="cardbox-container">
    <div class="cardbox">
        <div class="cardbox-number">
            {{ $users->filter(function ($user) {return $user->role === 'user';})->count() }} Pengguna Terdaftar
        </div>
    </div>
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
                <th>Progress Status</th>
                <th>Tanggal Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->barang->nama_barang }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->statusPemesanan }}</td>
                    <td>
                        {{-- Progress Status --}}
                        {{-- Progress Status --}}
                        <div class="progress-container">
                            @php
                                // Definisikan tahapan progress
                                $progressStages = ['Menunggu Proses Pemesanan', 'Sedang Diproses', 'Selesai'];
                                $isCancelled = $order->statusPemesanan === 'Dibatalkan';

                                // Tentukan tahap saat ini
                                $currentStage = $isCancelled
                                    ? -1 // Jika dibatalkan, progress tidak dihitung
                                    : array_search($order->statusPemesanan, $progressStages);

                                // Total tahapan progress
                                $totalStages = count($progressStages) - 1;

                                // Hitung persentase progress
                                $progressPercentage = $isCancelled
                                    ? 0 // Progress 0 jika dibatalkan
                                    : ($currentStage / $totalStages) * 100;
                            @endphp

                            {{-- Progress Bar --}}
                            <div class="progress-bar">
                                @if ($isCancelled)
                                    <div class="progress-cancelled" style="width: 100%; background-color: red;">
                                        Dibatalkan</div>
                                @else
                                    <div class="progress"
                                        style="width: {{ $progressPercentage }}%; background-color: green;">
                                    </div>
                                @endif
                            </div>

                            {{-- Progress Labels --}}
                            <div class="progress-labels">
                                @foreach ($progressStages as $index => $stage)
                                    <span class="{{ $index === $currentStage ? 'active' : '' }}">
                                        {{ $stage }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                    </td>

                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



<!-- Tabel Pengguna yang dapat discroll jika lebih dari 10 -->
<div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>role</th>
                <th>Tanggal Registrasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $key => $user)
                @if ($user->role === 'user')
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
                    <td colspan="4">Belum ada pengguna yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Tambahkan grafik -->
<h2>Grafik Pengguna</h2>
<div>
    <canvas id="userChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    const labels = [
        @foreach ($users as $user)
            '{{ $user->created_at->format('d-m-Y') }}',
        @endforeach
    ];

    const data = {
        labels: [...new Set(labels)], // Hanya ambil tanggal unik
        datasets: [{
            label: 'Jumlah Pengguna Baru',
            data: Object.values(labels.reduce((acc, curr) => {
                acc[curr] = (acc[curr] || 0) + 1;
                return acc;
            }, {})),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'line', // Gunakan tipe "line" untuk kurva
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    new Chart(ctx, config);
</script>
