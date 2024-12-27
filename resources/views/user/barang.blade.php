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
